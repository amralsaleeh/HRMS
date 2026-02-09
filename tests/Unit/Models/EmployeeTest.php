<?php

namespace Tests\Unit\Models;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Timeline;
use Tests\TestCase;

class EmployeeTest extends TestCase
{

    public function test_full_name_attribute(): void
    {
        $employee = Employee::factory()->create([
            'first_name' => 'John',
            'father_name' => 'Robert',
            'last_name' => 'Doe',
        ]);

        $this->assertSame('John Robert Doe', $employee->full_name);
    }

    public function test_short_name_attribute(): void
    {
        $employee = Employee::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
        ]);

        $this->assertSame('Jane Smith', $employee->short_name);
    }

    public function test_contract_relationship(): void
    {
        $employee = Employee::factory()->create();

        $this->assertInstanceOf(Contract::class, $employee->contract);
        $this->assertSame($employee->contract_id, $employee->contract->id);
    }

    public function test_timelines_relationship(): void
    {
        $employee = Employee::factory()->create();

        $this->assertInstanceOf(Timeline::class, $employee->timelines()->getRelated());
        $this->assertSame('employee_id', $employee->timelines()->getForeignKeyName());
    }

    public function test_leaves_relationship(): void
    {
        $employee = Employee::factory()->create();

        $this->assertInstanceOf(Leave::class, $employee->leaves()->getRelated());
    }

    public function test_current_position_returns_dash_when_no_timeline(): void
    {
        $employee = Employee::factory()->create();

        $this->assertSame('---', $employee->current_position);
    }

    public function test_current_department_returns_dash_when_no_timeline(): void
    {
        $employee = Employee::factory()->create();

        $this->assertSame('---', $employee->current_department);
    }

    public function test_current_center_returns_dash_when_no_timeline(): void
    {
        $employee = Employee::factory()->create();

        $this->assertSame('---', $employee->current_center);
    }

    public function test_hourly_counter_formats_as_h_i(): void
    {
        $employee = Employee::factory()->create(['hourly_counter' => '01:30:00']);
        $this->assertSame('01:30', $employee->hourly_counter);
    }

    public function test_hourly_counter_returns_empty_when_null(): void
    {
        $employee = new Employee;
        $employee->setRawAttributes(['hourly_counter' => null]);
        $this->assertSame('', $employee->hourly_counter);
    }

    public function test_delay_counter_formats_as_h_i(): void
    {
        $employee = Employee::factory()->create(['delay_counter' => '00:15:00']);
        $this->assertSame('00:15', $employee->delay_counter);
    }

    public function test_delay_counter_returns_empty_when_null(): void
    {
        $employee = new Employee;
        $employee->setRawAttributes(['delay_counter' => null]);
        $this->assertSame('', $employee->delay_counter);
    }
}
