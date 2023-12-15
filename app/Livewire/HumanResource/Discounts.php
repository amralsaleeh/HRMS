<?php

namespace App\Livewire\HumanResource;

use App\Models\Center;
use App\Models\Discount;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Livewire\Component;

class Discounts extends Component
{
    // Variables - Start //
    public $disableDateLimit;

    public $batch = '2023-10-18 to 2023-11-16'; // TESTING

    public $allCenters;
    // Variables - End //

    public function mount()
    {
        $this->allCenters = Center::where('is_active', true)->get(['id', 'start_work_hour', 'end_work_hour', 'weekends']);
        // $this->disableDateLimit = substr(Discount::latest()->first()->batch, -10);
    }

    public function render()
    {
        $this->calculateDiscounts(); // TESTING

        $employeeDiscounts = Employee::with('discounts')->whereHas('discounts', function ($query) {
            $query->where('batch', $this->batch);
        })->get()->each(function ($employee) {
            $employee->discounts = $employee->discounts->sortBy('date');
        });

        return view('livewire.human-resource.discounts', ['employeeDiscounts' => $employeeDiscounts]);
    }

    public function calculateDiscounts()
    {
        $this->validate([
            'batch' => 'required',
        ], [
            'batch.required' => 'Please select the period you want to apply the discount on',
        ]);

        $dates = explode(' to ', $this->batch);
        $fromDate = Carbon::create($dates[0]);
        $toDate = Carbon::create($dates[1]);

        foreach ($this->allCenters as $center) {
            $workDays = $this->calculateWorkDays($center, $fromDate, $toDate);
            $workDaysInMinutes = count($workDays) * Carbon::parse($center->start_work_hour)->diffInMinutes(Carbon::parse($center->end_work_hour));

            $centerEmployees = $this->getCenterEmployees($center->id);

            foreach ($centerEmployees as $employee) {
                $employeeContract = $employee->contract()->first();
                $employeeLeaves = $employee->leaves()->where('to_date', '>=', $fromDate)->where('is_checked', 0)->get();
                $employeeFingerprints = $this->getEmployeeFingerprints($workDays, $employee);

                $employeeTotalWorkDaysInMinutes = intval($workDaysInMinutes * ($employeeContract->work_rate / 100));
                $employeeWorkDayDuration = intval(($workDaysInMinutes * ($employeeContract->work_rate / 100)) / count($workDays));
                $workedTime = 0;
                $excusedTime = 0;

                foreach ($employeeLeaves as $leave) {
                    // اجازة - يومية - اداري
                    if ($leave->id == 1101) {
                        $start_date = Carbon::create($leave->pivot->from_date);
                        $dates = $start_date->range($leave->pivot->to_date);

                        foreach ($dates as $date) {
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $date);
                            } else {
                                $employee->discounts()->firstOrCreate([
                                    'rate' => $leave->discount_rate,
                                    'date' => $date,
                                    'reason' => 'Administrative leave - Exceeded the balance',
                                    'batch' => $this->batch,
                                ]);
                            }
                            $this->setFingerprintIsChecked($employeeFingerprints, $date);
                        }

                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // اجازة - يومية - بلا راتب
                    if ($leave->id == 1103) {
                        $this->createDiscountFromLeave($employee, $employeeFingerprints, $leave, 'Unpaid leave');
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // اجازة - يومية - صحي (تقرير)
                    if ($leave->id == 1104) {
                        $this->createDiscountFromLeave($employee, $employeeFingerprints, $leave, 'Health (Report) leave');
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // اجازة - ساعية - اداري
                    if ($leave->id == 1201) {
                        $duration = Carbon::parse($leave->pivot->start_at)->diff(Carbon::parse($leave->pivot->end_at));
                        if ($duration >= '03:00:00') { // TODO: Make 03:00:00 inserted variable on settings table
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $leave->pivot->from_date);
                            } else {
                                $this->createDiscountFromLeave($employee, $leave, 'Administrative leave - Exceeded the 3 hours limit', 1);
                            }
                            $this->setFingerprintIsChecked($employeeFingerprints, $leave->pivot->from_date);
                        } else {
                            $employee->update([
                                'hourly_counter' => Carbon::parse($employee->hourly_counter)->addHours($duration->h)->addMinutes($duration->i),
                            ]);
                            if ($employee->hourly_counter >= '07:00:00') { // TODO: Make 07:00:00 inserted variable on settings table
                                if ($employee->max_leave_allowed > 0) {
                                    $this->decrementMaxLeaveAllowed($employee, $leave->pivot->from_date);
                                } else {
                                    $this->createDiscountFromLeave($employee, $leave, 'Administrative leave - Rounded', 1);
                                }
                                $employee->update([
                                    'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                                ]);
                                $this->setFingerprintIsChecked($employeeFingerprints, $leave->pivot->from_date);
                            }
                        }
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }
                }

                $employeeFingerprints = $this->getEmployeeFingerprints($workDays, $employee);
                foreach ($employeeFingerprints as $fingerprint) {
                    if ($fingerprint->log == null) {
                        // No fingerprint
                        if (! $this->isThereDailyExcuse($fingerprint, $employeeLeaves)) {
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $fingerprint->date);
                            } else {
                                $this->createDiscountFromFingerprint($employee, $fingerprint, 'Absent without excuse', 1);
                            }
                        }
                    } elseif ($fingerprint->check_out == null) {
                        // TODO: Refactor code to enhance this critical situation
                        // One fingerprint
                        if (! $this->isThereDailyExcuse($fingerprint, $employeeLeaves)) {
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $fingerprint->date);
                            } else {
                                $this->createDiscountFromFingerprint($employee, $fingerprint, 'Partial attendance', 1);
                            }
                        }
                    } else {
                        // Two fingerprint
                        $isDelay = $this->checkIfDelay($center, $employee, $fingerprint);
                        $isEarly = $this->checkIfEarly($center, $employee, $employeeLeaves, $fingerprint);

                        if (! $isDelay && ! $isEarly) {
                            // الموظف مو متاخر ولا طالع بكير بس ممكن يكون جاي بعد ال 9:30
                            $this->checkIfLate($center, $employee, $employeeLeaves, $fingerprint);
                        }
                    }

                    $fingerprint->is_checked = 1;
                    $fingerprint->save();
                }
            }
        }
    }

    public function calculateWorkDays($center, $fromDate, $toDate)
    {
        $centerHolidays = $center->holidays()->where('to_date', '>=', $fromDate)->get();
        $workDaysWithoutHolidays = CarbonPeriod::create($fromDate, $toDate)->toArray();

        foreach ($centerHolidays as $holiday) {
            $periodToDelete = CarbonPeriod::create($holiday->from_date, $holiday->to_date)->toArray();
            $workDaysWithoutHolidays = array_diff($workDaysWithoutHolidays, $periodToDelete);
        }

        $weekends = $center->weekends;
        $workDaysWithoutHolidaysAndWeekends = array_filter($workDaysWithoutHolidays, function (CarbonInterface $carbon) use ($weekends) {
            $dayOfWeek = $carbon->dayOfWeek;

            return ! in_array($dayOfWeek, $weekends);
        });

        return $workDaysWithoutHolidaysAndWeekends;
    }

    public function getCenterEmployees($centerId)
    {
        return Employee::whereHas('timelines', function ($query) use ($centerId) {
            $query->where('center_id', $centerId)
                ->whereNull('end_date');
        })->where('is_active', true)->get();
    }

    public function getEmployeeFingerprints($workDays, $employee)
    {
        $workDates = array_map(function ($carbonObject) {
            return $carbonObject->format('Y-m-d');
        }, $workDays);

        return $employee->fingerprints()->whereIn('date', $workDates)->where('is_checked', 0)->get();
    }

    public function decrementMaxLeaveAllowed($employee, $date)
    {
        $employee->decrement('max_leave_allowed');
        $employee->discounts()->firstOrCreate([
            'rate' => 0,
            'date' => $date,
            'reason' => 'Administrative leave - Taken off the balance',
            'is_auto' => 1,
            'batch' => $this->batch,
        ]);
    }

    public function createDiscountFromLeave($employee, $employeeFingerprints, $leave, $reason, $isAuto = 0)
    {
        $start_date = Carbon::create($leave->pivot->from_date);
        $dates = $start_date->range($leave->pivot->to_date);

        foreach ($dates as $date) {
            $employee->discounts()->firstOrCreate([
                'rate' => $leave->discount_rate,
                'date' => $date,
                'reason' => $reason,
                'is_auto' => $isAuto,
                'batch' => $this->batch,
            ]);
            $this->setFingerprintIsChecked($employeeFingerprints, $date);
        }
    }

    public function createDiscountFromFingerprint($employee, $fingerprint, $reason, $isAuto = 0)
    {
        $employee->discounts()->firstOrCreate([
            'rate' => 100,
            'date' => $fingerprint->date,
            'reason' => $reason,
            'is_auto' => $isAuto,
            'batch' => $this->batch,
        ]);
    }

    public function setFingerprintIsChecked($employeeFingerprints, $date)
    {
        $fingerprint = $employeeFingerprints->where('date', $date->format('Y-m-d'))->first();
        $fingerprint->is_checked = 1;
        $fingerprint->save();
    }

    public function checkIfDelay($center, $employee, $fingerprint)
    {
        $startOfWork = carbon::parse($center->start_work_hour)->addMinutes(5)->format('H:i'); // TODO: Make 5 inserted variable on settings table
        $delayLimit = carbon::parse($center->start_work_hour)->addMinutes(30)->format('H:i'); // TODO: Make 30 inserted variable on settings table

        if ($fingerprint->check_in > $startOfWork && $fingerprint->check_in < $delayLimit) {

            $duration = Carbon::parse($center->start_work_hour)->diff(Carbon::parse($fingerprint->check_in));
            $employee->update([
                'delay_counter' => Carbon::parse($employee->delay_counter)->addHours($duration->h)->addMinutes($duration->i),
            ]);

            $delayCounter = Carbon::parse($employee->delay_counter);
            $delayCounterLimit = Carbon::parse('02:00:00'); // TODO: Make 02:00:00 inserted variable on settings table

            if ($delayCounter->gt($delayCounterLimit)) {
                if ($employee->max_leave_allowed > 0) {
                    $this->decrementMaxLeaveAllowed($employee, $fingerprint->date);
                } else {
                    $this->createDiscountFromFingerprint($employee, $fingerprint, 'Delay leave - Rounded', 1);
                }
                $employee->update([
                    'delay_counter' => Carbon::parse($employee->delay_counter)->subHours(2), // TODO: 2 inserted variable on settings table
                ]);
            }

            return true;

        } else {
            return false;
        }
    }

    public function checkIfEarly($center, $employee, $employeeLeaves, $fingerprint)
    {
        $endOfWork = carbon::parse($center->end_work_hour)->subMinutes(5)->format('H:i'); // TODO: Make 5 inserted variable on settings table

        if ($fingerprint->check_out < $endOfWork) {
            $timeCovered = $this->isThereHourlyExcuse($fingerprint, $employeeLeaves);
            $fingerprint->check_out = Carbon::parse($fingerprint->check_out)->addHours($timeCovered->hour)->addMinutes($timeCovered->minute);

            if ($fingerprint->check_out >= $endOfWork) {
                return false;
            } else {
                $duration = Carbon::parse($center->end_work_hour)->diff(Carbon::parse($fingerprint->check_out));
                $employee->update([
                    'hourly_counter' => Carbon::parse($employee->hourly_counter)->addHours($duration->h)->addMinutes($duration->i),
                ]);

                $hourlyCounter = Carbon::parse($employee->hourly_counter);
                $hourlyCounterLimit = Carbon::parse('07:00:00'); // TODO: Make 07:00:00 inserted variable on settings table

                if ($hourlyCounter->gt($hourlyCounterLimit)) {
                    if ($employee->max_leave_allowed > 0) {
                        $this->decrementMaxLeaveAllowed($employee, $fingerprint->date);
                    } else {
                        $this->createDiscountFromFingerprint($employee, $fingerprint, 'Administrative leave - Rounded', 1);
                    }
                    $employee->update([
                        'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                    ]);
                }

                return true;
            }

        } else {
            return false;
        }
    }

    public function checkIfLate($center, $employee, $employeeLeaves, $fingerprint)
    {

    }

    public function isThereDailyExcuse($fingerprint, $employeeLeaves)
    {
        foreach ($employeeLeaves as $leave) {
            if ($fingerprint->date >= $leave->pivot->from_date && $fingerprint->date <= $leave->pivot->to_date && $leave->pivot->is_checked == 0 && substr($leave->id, 1, 1) == 1) {
                $fingerprint->excuse = $leave->name;
                $fingerprint->save();

                return true;
            }
        }

        return false;
    }

    public function isThereHourlyExcuse($fingerprint, $employeeLeaves)
    {
        $timeCovered = Carbon::create(null);

        foreach ($employeeLeaves as $leave) {
            if ($fingerprint->date == $leave->pivot->from_date && $leave->pivot->is_checked == 0 && substr($leave->id, 1, 1) == 2) {
                $duration = Carbon::parse($leave->pivot->start_at)->diff(Carbon::parse($leave->pivot->end_at));
                $timeCovered = $timeCovered->add($duration);

                $leave->pivot->is_checked = 1;
                $leave->pivot->save();
            }
        }

        return $timeCovered;
    }
}
