<?php

namespace Tests\Unit\Models;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Tests\TestCase;

class TimelineTest extends TestCase
{

    public function test_center_relationship(): void
    {
        $timeline = Timeline::factory()->create();

        $this->assertInstanceOf(Center::class, $timeline->center()->getRelated());
        $this->assertSame('center_id', $timeline->center()->getForeignKeyName());
    }

    public function test_department_relationship(): void
    {
        $timeline = Timeline::factory()->create();

        $this->assertInstanceOf(Department::class, $timeline->department()->getRelated());
    }

    public function test_position_relationship(): void
    {
        $timeline = Timeline::factory()->create();

        $this->assertInstanceOf(Position::class, $timeline->position()->getRelated());
    }

    public function test_employee_relationship(): void
    {
        $timeline = Timeline::factory()->create();

        $this->assertInstanceOf(Employee::class, $timeline->employee()->getRelated());
    }
}
