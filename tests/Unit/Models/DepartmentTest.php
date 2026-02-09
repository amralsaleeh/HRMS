<?php

namespace Tests\Unit\Models;

use App\Models\Department;
use App\Models\Timeline;
use Tests\TestCase;

class DepartmentTest extends TestCase
{

    public function test_name_setter_ucfirst(): void
    {
        $department = Department::factory()->create(['name' => 'it']);

        $this->assertSame('It', $department->name);
    }

    public function test_timelines_relationship(): void
    {
        $department = Department::factory()->create();

        $this->assertInstanceOf(Timeline::class, $department->timelines()->getRelated());
        $this->assertSame('department_id', $department->timelines()->getForeignKeyName());
    }
}
