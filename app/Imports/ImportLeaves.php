<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportLeaves implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $employee_id = $row[0];
        $leave_id = $this->InitializeLeaveId($row[1], $row[6]);
        $from_date = Carbon::createFromTimestamp(($row[2] - 25569) * 86400)->format('Y-m-d');
        $to_date = Carbon::createFromTimestamp(($row[3] - 25569) * 86400)->format('Y-m-d');
        $start_at = $row[4];
        $end_at = $row[5];

        // Check if row is not exists to avoid duplicate
        if (! Employee::CheckLeave($employee_id, $leave_id, $from_date, $to_date, $start_at, $end_at)->exists()) {

            $employee = Employee::find($employee_id);
            if ($employee) {
                $employee->leaves()->attach($leave_id, [
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'start_at' => $start_at,
                    'end_at' => $end_at,
                    'created_by' => Auth::user()->name,
                    'updated_by' => Auth::user()->name,
                ]);
            }

            return null;
        } else {
            return null;
        }
    }

    public function InitializeLeaveId($Id, $Type)
    {
        // Check if it's task or leave
        if ($Type >= 13 && $Type <= 17) {
            // Task
            $leave_id = '2'.$Id.$Type;
        } else {
            // Leave
            if (strlen($Type) == 1) {
                $leave_id = '1'.$Id.'0'.$Type;
            } else {
                $leave_id = '1'.$Id.$Type;
            }
        }

        if (strlen($leave_id) < 4) {
            throw new Exception('The $leave_id ('.$leave_id.') must be at least 4 characters long.');
        }

        return $leave_id;
    }
}
