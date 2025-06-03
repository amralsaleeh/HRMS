<?php

namespace App\Jobs;

use App\Models\Center;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\Fingerprint;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class calculateDiscountsAsDays implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Variables - Start //
    private $jobId;

    private $user;

    private $batch;

    private $allCenters;

    private $absenceThreshold;
    // Variables - End //

    public function __construct($user, $batch)
    {
        $this->user = $user;
        $this->batch = $batch;
        $this->allCenters = Center::where('is_active', true)->get(['id', 'start_work_hour', 'end_work_hour', 'weekends']);
        $this->absenceThreshold = CarbonInterval::hours(3)->totalSeconds; // TODO: Make 3 inserted variable on settings table
    }

    public function handle(): void
    {
        $this->jobId = $this->job->getJobId();

        $this->calculateDiscounts();

        Notification::send(
            $this->user,
            new DefaultNotification($this->user->id, 'Successfully calculate the employees discounts')
        );
    }

    public function calculateDiscounts()
    {
        $progress = 0;
        $progressStep = floor(100 / $this->allCenters->count());

        $dates = explode(' to ', $this->batch);
        $fromDate = Carbon::create($dates[0]);
        $toDate = Carbon::create($dates[1]);

        foreach ($this->allCenters as $center) {
            DB::table('jobs')
                ->where('id', $this->jobId)
                ->update([
                    'progress' => ($progress += $progressStep),
                ]);

            $startOfWork = carbon::parse($center->start_work_hour)
                ->addMinutes(5)
                ->format('H:i'); // TODO: Make 5 inserted variable on settings table
            $delayThreshold = carbon::parse($center->start_work_hour)
                ->addMinutes(29)
                ->format('H:i'); // TODO: Make 29 inserted variable on settings table
            $endOfWork = carbon::parse($center->end_work_hour)
                ->subMinutes(5)
                ->format('H:i'); // TODO: Make 5 inserted variable on settings table

            $workDays = $this->calculateWorkDays($center, $fromDate, $toDate);
            $workDaysInMinutes =
              count($workDays) *
              Carbon::parse($center->start_work_hour)->diffInMinutes(Carbon::parse($center->end_work_hour));

            $centerEmployees = $this->getCenterEmployees($center->id);

            foreach ($centerEmployees as $employee) {
                $employeeContract = $employee->contract()->first();
                [$employeeStartDate, $employeeEndDate] = $this->calculateTimelineHistory($employee);
                $employeeLeaves = $employee
                    ->leaves()
                    ->where('to_date', '>=', $fromDate)
                    ->where('is_checked', 0)
                    ->orderBy('from_date', 'asc')
                    ->get();

                $employeeFingerprints = $this->getEmployeeFingerprints($workDays, $employee);

                $employeeTotalWorkDaysInMinutes = intval($workDaysInMinutes * ($employeeContract->work_rate / 100));
                $employeeWorkDayDuration = intval(
                    ($workDaysInMinutes * ($employeeContract->work_rate / 100)) / count($workDays)
                );
                $workedTime = 0;
                $excusedTime = 0;

                // Split leaves and update $employeeLeaves after that
                $this->splitLeaves($employeeLeaves);
                $employeeLeaves = $employee
                    ->leaves()
                    ->where('to_date', '<=', $toDate)
                    ->where('is_checked', 0)
                    ->orderBy('from_date', 'asc')
                    ->get();

                foreach ($employeeLeaves as $leave) {
                    // 👉 اجازة - يومية - اداري
                    if ($leave->id == 1101) {
                        $startDate = Carbon::create($leave->pivot->from_date);
                        $dates = $startDate->range($leave->pivot->to_date);
                        foreach ($dates as $date) {
                            $holidayExcuse = $this->checkIfHoliday($date, $center);

                            if ($holidayExcuse) {
                                $this->setFingerprintIsChecked($employee->id, $date, 'Holiday: '.$holidayExcuse);

                                continue;
                            }

                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $date, 'Administrative leave');
                            } else {
                                $employee->discounts()->firstOrCreate([
                                    'rate' => $leave->discount_rate,
                                    'date' => $date,
                                    'reason' => 'Administrative leave - Exceeded the balance',
                                    'batch' => $this->batch,
                                ]);
                            }
                            $this->setFingerprintIsChecked($employee->id, $date, 'Administrative leave');
                        }
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // 👉 اجازة - يومية - بلا راتب
                    if ($leave->id == 1103) {
                        $this->createDiscountFromLeave($employee, $employeeFingerprints, $leave, 'Unpaid leave');
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // 👉 اجازة - يومية - صحي (تقرير)
                    if ($leave->id == 1104) {
                        $this->createDiscountFromLeave($employee, $employeeFingerprints, $leave, 'Health (report) leave');

                        $startDate = Carbon::create($leave->pivot->from_date);
                        $dates = $startDate->range($leave->pivot->to_date);

                        foreach ($dates as $date) {
                            $this->setFingerprintIsChecked($employee->id, $date, 'Health (report) leave');
                        }

                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // 👉 اجازة - ساعية - اداري
                    if ($leave->id == 1201) {
                        $holidayExcuse = $this->checkIfHoliday($leave->pivot->from_date, $center);
                        if ($holidayExcuse) {
                            continue;
                        }

                        $fingerprint = $employeeFingerprints->where('date', $leave->pivot->from_date)->first();
                        if ($fingerprint) {
                            if ($fingerprint->check_in <= $startOfWork && $fingerprint->check_out >= $endOfWork) {
                                $duration = Carbon::parse($leave->pivot->start_at)->diff(Carbon::parse($leave->pivot->end_at));
                                $durationInSeconds = Carbon::parse($leave->pivot->start_at)->diffInSeconds(
                                    Carbon::parse($leave->pivot->end_at)
                                );

                                if ($durationInSeconds > $this->absenceThreshold) {
                                    if ($employee->max_leave_allowed > 0) {
                                        $this->decrementMaxLeaveAllowed(
                                            $employee,
                                            $leave->pivot->from_date,
                                            'Administrative leave - Exceeded the 3 hours limit'
                                        );
                                    } else {
                                        $this->createDiscountFromLeave(
                                            $employee,
                                            $employeeFingerprints,
                                            $leave,
                                            'Administrative leave - Exceeded the 3 hours limit',
                                            1
                                        );
                                    }
                                    $this->setFingerprintIsChecked(
                                        $employee->id,
                                        Carbon::parse($leave->pivot->from_date),
                                        'Administrative leave - Exceeded the 3 hours limit'
                                    );
                                } else {
                                    $employee->update([
                                        'hourly_counter' => Carbon::parse($employee->hourly_counter)
                                            ->addHours($duration->h)
                                            ->addMinutes($duration->i),
                                    ]);
                                    if ($employee->hourly_counter >= '07:00:00') {
                                        // TODO: Make 07:00:00 inserted variable on settings table
                                        if ($employee->max_leave_allowed > 0) {
                                            $this->decrementMaxLeaveAllowed(
                                                $employee,
                                                $leave->pivot->from_date,
                                                'Administrative leave - Rounded'
                                            );
                                        } else {
                                            $this->createDiscountFromLeave(
                                                $employee,
                                                $employeeFingerprints,
                                                $leave,
                                                'Administrative leave - Rounded',
                                                1
                                            );
                                        }
                                        $employee->update([
                                            'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                                        ]);
                                        $this->setFingerprintIsChecked(
                                            $employee->id,
                                            Carbon::parse($leave->pivot->from_date),
                                            'Administrative leave - Rounded'
                                        );
                                    }
                                }
                            }
                        }
                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }

                    // مهمة - يومية
                    if (substr($leave->id, 0, 2) == '21') {
                        $startDate = Carbon::create($leave->pivot->from_date);
                        $dates = $startDate->range($leave->pivot->to_date);

                        foreach ($dates as $date) {
                            $this->setFingerprintIsChecked($employee->id, $date, 'Daily Task');
                        }

                        $leave->pivot->is_checked = 1;
                        $leave->pivot->save();
                    }
                }

                $employeeFingerprints = $this->getEmployeeFingerprints($workDays, $employee);
                foreach ($employeeFingerprints as $fingerprint) {
                    if ($fingerprint->date < $employeeStartDate) {
                        $fingerprint->update(['excuse' => 'Employee hasn\'t started working yet', 'is_checked' => 1]);

                        continue;
                    }
                    if ($employeeEndDate != null && $fingerprint->date > $employeeEndDate) {
                        $fingerprint->update(['excuse' => 'Employee resigned on '.$employeeEndDate, 'is_checked' => 1]);

                        continue;
                    }

                    if ($fingerprint->log == null) {
                        // No fingerprint
                        if (! $this->isThereDailyExcuse($fingerprint, $employeeLeaves)) {
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Absent without excuse');
                            } else {
                                $this->createDiscountFromFingerprint($employee, $fingerprint, 'Absent without excuse', 1);
                            }
                        }
                    } elseif ($fingerprint->check_out == null) {
                        // One fingerprint
                        if (! $this->isThereDailyExcuse($fingerprint, $employeeLeaves)) {
                            if ($employee->max_leave_allowed > 0) {
                                $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Partial attendance');
                            } else {
                                $this->createDiscountFromFingerprint($employee, $fingerprint, 'Partial attendance', 1);
                            }
                        }
                    } else {
                        // Two fingerprint
                        $isDelay = $this->checkIfDelay($center, $employee, $fingerprint, $startOfWork, $delayThreshold);
                        $isEarly = $this->checkIfEarly($center, $employee, $employeeLeaves, $fingerprint, $endOfWork);
                        $isLate = $this->checkIfLate(
                            $center,
                            $employee,
                            $employeeLeaves,
                            $fingerprint,
                            $startOfWork,
                            $delayThreshold
                        );
                        // if (! $isDelay && ! $isEarly) {
                        // }
                    }
                    // Debugbar::info('1 --- '.$fingerprint->date.' - - - hourly_counter: '.Carbon::parse($employee->hourly_counter)->format('H:i').' - - - delay_counter: '.Carbon::parse($employee->delay_counter)->format('H:i'));

                    $fingerprint->refresh();
                    $fingerprint->is_checked = 1;
                    $fingerprint->save();
                }
            }
        }
    }

    public function getEmployeeDiscounts()
    {
        return Employee::whereHas('discounts', function ($query) {
            $query->whereBetween('date', explode(' to ', $this->batch));
        })
            ->with([
                'discounts' => function ($query) {
                    $query->whereBetween('date', explode(' to ', $this->batch));
                },
            ])
            ->get()
            ->each(function ($employee) {
                $employee->discounts = $employee->discounts->sortBy('date');
                $employee->cash_discounts_count = $employee->discounts
                    ->filter(function ($discount) {
                        return $discount->rate > 0;
                    })
                    ->count();
            })
            ->sortBy('first_name');
    }

    public function calculateWorkDays($center, $fromDate, $toDate)
    {
        $centerHolidays = $center
            ->holidays()
            ->where('to_date', '>=', $fromDate)
            ->get();
        $workDaysWithoutHolidays = CarbonPeriod::create($fromDate, $toDate)->toArray();

        foreach ($centerHolidays as $holiday) {
            $periodToDelete = CarbonPeriod::create($holiday->from_date, $holiday->to_date)->toArray();
            $workDaysWithoutHolidays = array_diff($workDaysWithoutHolidays, $periodToDelete);
        }

        $weekends = $center->weekends;

        return array_filter($workDaysWithoutHolidays, function (CarbonInterface $carbon) use ($weekends) {
            $dayOfWeek = $carbon->dayOfWeek;

            return ! in_array($dayOfWeek, $weekends);
        });
    }

    public function getCenterEmployees($centerId)
    {
        return Employee::whereHas('timelines', function ($query) use ($centerId) {
            $query->where('center_id', $centerId)->whereNull('end_date');
        })
            ->where('is_active', true)
            ->get();
    }

    public function calculateTimelineHistory($employee)
    {
        $timelines = $employee->timelines()->get();
        $timelinesCount = count($timelines);

        if ($timelinesCount === 1) {
            $startDate = $timelines[0]->start_date;
            $endDate = $timelines[0]->end_date;
        } else {
            $startDate = $timelines[0]->start_date;
            $endDate = $timelines[$timelinesCount - 1]->end_date;
        }

        return [$startDate, $endDate];
    }

    public function getEmployeeFingerprints($workDays, $employee)
    {
        $workDates = array_map(function ($carbonObject) {
            return $carbonObject->format('Y-m-d');
        }, $workDays);

        return $employee
            ->fingerprints()
            ->whereIn('date', $workDates)
            ->where('is_checked', 0)
            ->orderBy('date', 'asc')
            ->get();
    }

    public function splitLeaves($employeeLeaves)
    {
        $dates = explode(' to ', $this->batch);
        $fromDate = Carbon::create($dates[0]);
        $toDate = Carbon::create($dates[1]);

        $splitDate = $toDate;

        foreach ($employeeLeaves as $leave) {
            $startDate = Carbon::parse($leave->pivot->from_date);
            $endDate = Carbon::parse($leave->pivot->to_date);

            if ($splitDate >= $startDate && $endDate > $splitDate && $startDate != $endDate) {
                $firstLeave = EmployeeLeave::create([
                    'employee_id' => $leave->pivot->employee_id,
                    'leave_id' => $leave->pivot->leave_id,
                    'from_date' => $startDate,
                    'to_date' => $splitDate->copy(),
                    'start_at' => $leave->pivot->start_at,
                    'end_at' => $leave->pivot->end_at,
                    'note' => $leave->pivot->note,
                    'is_authorized' => $leave->pivot->is_authorized,
                    'is_checked' => $leave->pivot->is_checked,
                ]);

                $secondLeave = EmployeeLeave::create([
                    'employee_id' => $leave->pivot->employee_id,
                    'leave_id' => $leave->pivot->leave_id,
                    'from_date' => $splitDate->copy()->addDay(),
                    'to_date' => $endDate,
                    'start_at' => $leave->pivot->start_at,
                    'end_at' => $leave->pivot->end_at,
                    'note' => $leave->pivot->note,
                    'is_authorized' => $leave->pivot->is_authorized,
                    'is_checked' => $leave->pivot->is_checked,
                ]);

                EmployeeLeave::find($leave->pivot->id)->update([
                    'note' => 'Splitted into: '.$firstLeave->id.' & '.$secondLeave->id,
                    'is_checked' => 1,
                ]);
            }
        }
    }

    // test
    public function decrementMaxLeaveAllowed($employee, $date, $reason)
    {
        $employee->decrement('max_leave_allowed');
        $employee->discounts()->firstOrCreate([
            'rate' => 0,
            'date' => $date,
            'reason' => $reason.' - Taken off the balance',
            'is_auto' => 1,
            'batch' => $this->batch,
        ]);
    }

    public function createDiscountFromLeave($employee, $employeeFingerprints, $leave, $reason, $isAuto = 0)
    {
        $startDate = Carbon::create($leave->pivot->from_date);
        $dates = $startDate->range($leave->pivot->to_date);

        foreach ($dates as $date) {
            $employee->discounts()->firstOrCreate([
                'rate' => $leave->discount_rate,
                'date' => $date,
                'reason' => $reason,
                'is_auto' => $isAuto,
                'batch' => $this->batch,
            ]);
            $this->setFingerprintIsChecked($employee->id, $date, $reason);
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

    public function setFingerprintIsChecked($id, $date, $excuse)
    {
        $fingerprint = Fingerprint::where('employee_id', $id)
            ->where('date', $date->format('Y-m-d'))
            ->first();

        if ($fingerprint) {
            $fingerprint->excuse = $excuse;
            $fingerprint->is_checked = 1;
            $fingerprint->save();
        }
    }

    public function checkIfDelay($center, $employee, $fingerprint, $startOfWork, $delayThreshold)
    {
        if ($fingerprint->check_in > $startOfWork && $fingerprint->check_in < $delayThreshold) {
            $duration = Carbon::parse($center->start_work_hour)->diff(Carbon::parse($fingerprint->check_in));
            $employee->update([
                'delay_counter' => Carbon::parse($employee->delay_counter)
                    ->addHours($duration->h)
                    ->addMinutes($duration->i),
            ]);

            $delayCounter = Carbon::parse($employee->delay_counter);
            $delayCounterLimit = Carbon::parse('02:00:00'); // TODO: Make 02:00:00 inserted variable on settings table

            if ($delayCounter->gt($delayCounterLimit)) {
                if ($employee->max_leave_allowed > 0) {
                    $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Delay leave - Rounded');
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

    public function checkIfHoliday($date, $center)
    {
        $holiday = $center->getHoliday($date);

        if ($holiday) {
            return $holiday->name;
        } else {
            return null;
        }
    }

    public function checkIfEarly($center, $employee, $employeeLeaves, $fingerprint, $endOfWork)
    {
        if ($fingerprint->check_out < $endOfWork) {
            $timeCovered = $this->isThereHourlyEarlyExcuse($fingerprint, $employeeLeaves);
            $fingerprint->check_out = Carbon::parse($fingerprint->check_out)
                ->addHours($timeCovered->hour)
                ->addMinutes($timeCovered->minute);

            if ($fingerprint->check_out >= $endOfWork) {
                return false;
            } else {
                $duration = Carbon::parse($fingerprint->check_out)->diff(Carbon::parse($center->end_work_hour));
                $durationInSeconds = Carbon::parse($fingerprint->check_out)->diffInSeconds(
                    Carbon::parse($center->end_work_hour)
                );

                if ($durationInSeconds > $this->absenceThreshold) {
                    if ($employee->max_leave_allowed > 0) {
                        $this->decrementMaxLeaveAllowed(
                            $employee,
                            $fingerprint->date,
                            'Administrative leave - Exceeded the 3 hours limit'
                        );
                    } else {
                        $this->createDiscountFromFingerprint(
                            $employee,
                            $fingerprint,
                            'Administrative leave - Exceeded the 3 hours limit',
                            1
                        );
                    }

                    return true;
                } else {
                    $employee->update([
                        'hourly_counter' => Carbon::parse($employee->hourly_counter)
                            ->addHours($duration->h)
                            ->addMinutes($duration->i),
                    ]);

                    $hourlyCounter = Carbon::parse($employee->hourly_counter);
                    $hourlyCounterLimit = Carbon::parse('07:00:00'); // TODO: Make 07:00:00 inserted variable on settings table

                    if ($hourlyCounter->gt($hourlyCounterLimit)) {
                        if ($employee->max_leave_allowed > 0) {
                            $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Administrative leave - Rounded');
                        } else {
                            $this->createDiscountFromFingerprint($employee, $fingerprint, 'Administrative leave - Rounded', 1);
                        }
                        $employee->update([
                            'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                        ]);
                    }

                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function checkIfLate($center, $employee, $employeeLeaves, $fingerprint, $startOfWork, $delayThreshold)
    {
        if ($fingerprint->check_in >= $delayThreshold) {
            $timeCovered = $this->isThereHourlyLateExcuse($fingerprint, $employeeLeaves);
            $fingerprint->check_in = Carbon::parse($fingerprint->check_in)
                ->subHours($timeCovered->hour)
                ->subMinutes($timeCovered->minute);

            if ($fingerprint->check_in < $delayThreshold) {
                // $this->checkIfDelay($center, $employee, $fingerprint, $startOfWork, $delayThreshold);
                $duration = Carbon::parse($center->start_work_hour)->diff(Carbon::parse($fingerprint->check_in));
                $durationInSeconds = Carbon::parse($center->start_work_hour)->diffInSeconds(
                    Carbon::parse($fingerprint->check_in)
                );

                $employee->update([
                    'hourly_counter' => Carbon::parse($employee->hourly_counter)
                        ->addHours($duration->h)
                        ->addMinutes($duration->i),
                ]);

                $hourlyCounter = Carbon::parse($employee->hourly_counter);
                $hourlyCounterLimit = Carbon::parse('07:00:00'); // TODO: Make 07:00:00 inserted variable on settings table

                if ($hourlyCounter->gt($hourlyCounterLimit)) {
                    if ($employee->max_leave_allowed > 0) {
                        $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Administrative leave - Rounded');
                    } else {
                        $this->createDiscountFromFingerprint($employee, $fingerprint, 'Administrative leave - Rounded', 1);
                    }
                    $employee->update([
                        'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                    ]);
                }

                return true;
                // return false;
            } else {
                $duration = Carbon::parse($center->start_work_hour)->diff(Carbon::parse($fingerprint->check_in));
                $durationInSeconds = Carbon::parse($center->start_work_hour)->diffInSeconds(
                    Carbon::parse($fingerprint->check_in)
                );

                if ($durationInSeconds > $this->absenceThreshold) {
                    if ($employee->max_leave_allowed > 0) {
                        $this->decrementMaxLeaveAllowed(
                            $employee,
                            $fingerprint->date,
                            'Administrative leave - Exceeded the 3 hours limit'
                        );
                    } else {
                        $this->createDiscountFromFingerprint(
                            $employee,
                            $fingerprint,
                            'Administrative leave - Exceeded the 3 hours limit',
                            1
                        );
                    }

                    return true;
                } else {
                    $employee->update([
                        'hourly_counter' => Carbon::parse($employee->hourly_counter)
                            ->addHours($duration->h)
                            ->addMinutes($duration->i),
                    ]);

                    $hourlyCounter = Carbon::parse($employee->hourly_counter);
                    $hourlyCounterLimit = Carbon::parse('07:00:00'); // TODO: Make 07:00:00 inserted variable on settings table

                    if ($hourlyCounter->gt($hourlyCounterLimit)) {
                        if ($employee->max_leave_allowed > 0) {
                            $this->decrementMaxLeaveAllowed($employee, $fingerprint->date, 'Administrative leave - Rounded');
                        } else {
                            $this->createDiscountFromFingerprint($employee, $fingerprint, 'Administrative leave - Rounded', 1);
                        }
                        $employee->update([
                            'hourly_counter' => Carbon::parse($employee->hourly_counter)->subHours(7), // TODO: Make 7 inserted variable on settings table
                        ]);
                    }

                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public function isThereDailyExcuse($fingerprint, $employeeLeaves)
    {
        foreach ($employeeLeaves as $leave) {
            if (
                $fingerprint->date >= $leave->pivot->from_date &&
                $fingerprint->date <= $leave->pivot->to_date &&
                $leave->pivot->is_checked == 0 &&
                substr($leave->id, 1, 1) == 1
            ) {
                $fingerprint->excuse = $leave->name;
                $fingerprint->save();

                if ($leave->pivot->from_date === $leave->pivot->to_date || $fingerprint->date >= $leave->pivot->to_date) {
                    $leave->pivot->is_checked = 1;
                    $leave->pivot->save();
                }

                return true;
            }
        }

        return false;
    }

    public function isThereHourlyLateExcuse($fingerprint, $employeeLeaves)
    {
        $timeCovered = Carbon::create(null);

        foreach ($employeeLeaves as $leave) {
            if (
                $fingerprint->date >= $leave->pivot->from_date &&
                $fingerprint->date <= $leave->pivot->to_date &&
                $leave->pivot->start_at < $fingerprint->check_in &&
                $leave->pivot->is_checked == 0 &&
                substr($leave->id, 1, 1) == 2
            ) {
                $duration = Carbon::parse($leave->pivot->start_at)->diff(Carbon::parse($leave->pivot->end_at));

                $timeCovered = $timeCovered->add($duration);

                if ($leave->pivot->leave_id != 1210) {
                    $leave->pivot->is_checked = 1;
                }
                $leave->pivot->save();
            }
        }

        return $timeCovered;
    }

    public function isThereHourlyEarlyExcuse($fingerprint, $employeeLeaves)
    {
        $timeCovered = Carbon::create(null);

        foreach ($employeeLeaves as $leave) {
            if (
                $fingerprint->date >= $leave->pivot->from_date &&
                $fingerprint->date <= $leave->pivot->to_date &&
                $leave->pivot->end_at > $fingerprint->check_out &&
                $leave->pivot->is_checked == 0 &&
                substr($leave->id, 1, 1) == 2
            ) {
                $duration = Carbon::parse($leave->pivot->start_at)->diff(Carbon::parse($leave->pivot->end_at));

                $timeCovered = $timeCovered->add($duration);

                if ($leave->pivot->leave_id != 1210) {
                    $leave->pivot->is_checked = 1;
                }
                $leave->pivot->save();
            }
        }

        return $timeCovered;
    }
}
