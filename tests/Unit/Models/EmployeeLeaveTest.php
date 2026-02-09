<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\Leave;
use Tests\TestCase;

class EmployeeLeaveTest extends TestCase
{

    private function createLeave(): Leave
    {
        $leave = new Leave;
        $leave->name = 'Sick';
        $leave->is_instantly = true;
        $leave->is_accumulative = true;
        $leave->discount_rate = 50;
        $leave->days_limit = 21;
        $leave->minutes_limit = 0;
        $leave->created_by = 'System';
        $leave->updated_by = 'System';
        $leave->save();

        return $leave;
    }

    public function test_fillable_attributes(): void
    {
        $employee = Employee::factory()->create();
        $leave = $this->createLeave();
        $employeeLeave = EmployeeLeave::create([
            'employee_id' => $employee->id,
            'leave_id' => $leave->id,
            'from_date' => '2025-01-01',
            'to_date' => '2025-01-05',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame($employee->id, $employeeLeave->employee_id);
        $this->assertSame($leave->id, $employeeLeave->leave_id);
        $this->assertSame('2025-01-01', $employeeLeave->from_date);
    }
}
