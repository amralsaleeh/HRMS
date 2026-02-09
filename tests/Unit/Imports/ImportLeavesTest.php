<?php

namespace Tests\Unit\Imports;

use App\Imports\ImportLeaves;
use App\Models\Employee;
use App\Models\Leave;
use Tests\TestCase;

class ImportLeavesTest extends TestCase
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

    public function test_start_row_returns_two(): void
    {
        $import = new ImportLeaves;

        $this->assertSame(2, $import->startRow());
    }

    public function test_initialize_leave_id_task_type(): void
    {
        $import = new ImportLeaves;

        $result = $import->InitializeLeaveId('1', 15);

        $this->assertSame('2115', $result);
    }

    public function test_initialize_leave_id_leave_type_single_digit(): void
    {
        $import = new ImportLeaves;

        $result = $import->InitializeLeaveId('1', '2');

        $this->assertSame('1102', $result);
    }

    public function test_initialize_leave_id_leave_type_multi_digit(): void
    {
        $import = new ImportLeaves;

        $result = $import->InitializeLeaveId('1', '12');

        $this->assertSame('1112', $result);
    }

    public function test_initialize_leave_id_throws_when_short(): void
    {
        $import = new ImportLeaves;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('must be at least 4 characters');

        $import->InitializeLeaveId('1', '');
    }

    public function test_model_returns_null_when_duplicate_leave(): void
    {
        $employee = Employee::factory()->create();
        Leave::insert([
            'id' => 1101,
            'name' => 'Sick',
            'is_instantly' => 1,
            'is_accumulative' => 1,
            'discount_rate' => 50,
            'days_limit' => 21,
            'minutes_limit' => 0,
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $employee->leaves()->attach(1101, [
            'from_date' => '2024-02-02',
            'to_date' => '2024-02-06',
            'start_at' => '08:00',
            'end_at' => '17:00',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
        $user = \App\Models\User::factory()->create(['name' => 'Admin']);
        $this->actingAs($user);

        $import = new ImportLeaves;
        $row = [$employee->id, 1, 45324, 45328, '08:00', '17:00', 1];
        $result = $import->model($row);

        $this->assertNull($result);
    }

    public function test_model_attaches_leave_when_employee_exists_and_not_duplicate(): void
    {
        $employee = Employee::factory()->create();
        Leave::insert([
            'id' => 1101,
            'name' => 'Sick',
            'is_instantly' => 1,
            'is_accumulative' => 1,
            'discount_rate' => 50,
            'days_limit' => 21,
            'minutes_limit' => 0,
            'created_by' => 'System',
            'updated_by' => 'System',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $user = \App\Models\User::factory()->create(['name' => 'Admin']);
        $this->actingAs($user);

        $import = new ImportLeaves;
        $row = [$employee->id, 1, 45324, 45328, '08:00', '17:00', 1];
        $import->model($row);

        $this->assertDatabaseHas('employee_leave', [
            'employee_id' => $employee->id,
            'leave_id' => 1101,
            'from_date' => '2024-02-02',
            'to_date' => '2024-02-06',
        ]);
    }

    public function test_model_returns_null_when_employee_not_found(): void
    {
        $user = \App\Models\User::factory()->create(['name' => 'Admin']);
        $this->actingAs($user);

        $import = new ImportLeaves;
        $row = [99999, 1, 45324, 45328, '08:00', '17:00', 1];
        $result = $import->model($row);

        $this->assertNull($result);
    }
}
