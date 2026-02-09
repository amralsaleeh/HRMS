<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\Leave;
use Tests\TestCase;

class LeaveTest extends TestCase
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

    public function test_employees_relationship(): void
    {
        $leave = $this->createLeave();

        $this->assertInstanceOf(Employee::class, $leave->employees()->getRelated());
    }
}
