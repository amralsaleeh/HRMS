<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Console\Command;

class LeavesCalculator extends Command
{
    /**
     * The name and signature of the command.
     *
     * @var string
     */
    protected $signature = 'LeavesCalculator';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'A monthly task that calculates the number of leaves that will be added to the employee based on the year he joins the job.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // balance_leave_allowed: The cumulative leave balance (non-deductible) is reset at the beginning of each year only.
        // max_leave_allowed: Cumulative leave balance (deducted) every time the employee takes leave.

        $activeEmployees = Employee::where('is_active', true)->get();

        foreach ($activeEmployees as $employee) {
            // 👉 10 Years
            if ($employee->workedYears >= 10) {
                if (Carbon::now()->month == 1) {
                    $employee->balance_leave_allowed += 5;
                    $employee->max_leave_allowed += 5;
                } elseif (Carbon::now()->month == 7) {
                    $employee->balance_leave_allowed += 5;
                    $employee->max_leave_allowed += 5;
                } else {
                    $employee->balance_leave_allowed += 2;
                    $employee->max_leave_allowed += 2;
                }
            }
            // 👉 6 - 9 Years
            elseif ($employee->workedYears >= 6 && $employee->workedYears <= 9) {
                if (Carbon::now()->month == 7) {
                    $employee->balance_leave_allowed += 4;
                    $employee->max_leave_allowed += 4;
                } else {
                    $employee->balance_leave_allowed += 2;
                    $employee->max_leave_allowed += 2;
                }
            }
            // 👉 5 Years
            elseif ($employee->workedYears == 5) {
                if (Carbon::now()->month == 7) {
                    $employee->balance_leave_allowed += 4;
                    $employee->max_leave_allowed += 4;
                } elseif (Carbon::now()->month >= 8) {
                    $employee->balance_leave_allowed += 1;
                    $employee->max_leave_allowed += 1;
                } else {
                    $employee->balance_leave_allowed += 2;
                    $employee->max_leave_allowed += 2;
                }
            }
            // 👉 4 Years
            elseif ($employee->workedYears <= 4) {
                if (Carbon::now()->month == 7) {
                    if ($this->checkIsJokerValid($employee)) {
                        $employee->balance_leave_allowed += 3;
                        $employee->max_leave_allowed += 3;
                    } else {
                        $employee->balance_leave_allowed += 1;
                        $employee->max_leave_allowed += 1;
                    }
                } else {
                    $employee->balance_leave_allowed += 1;
                    $employee->max_leave_allowed += 1;
                }
            }

            info('LeavesCalculator: Emp_Id: '.$employee->id.' - MLA: '.$employee->max_leave_allowed);
            $employee->save();
        }

        return 1;
    }

    public function checkIsJokerValid($employee)
    {
        $startDate = Carbon::parse(
            Timeline::where('employee_id', $employee->id)
                ->where('is_sequent', 1)
                ->orderBy('start_date')
                ->first()?->start_date
        );

        if ($startDate->year == Carbon::now()->year && $startDate->month == 7) {
            return false;
        }

        return true;
    }
}
