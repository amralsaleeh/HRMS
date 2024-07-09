<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        $employees = Employee::select('id')->pluck('id')->random(5);
        $centers = Center::select('id')->pluck('id')->random(5);
        $departments = Department::select('id')->pluck('id')->random(5);
        $positions = Position::select('id')->pluck('id')->random(5);

        for ($i = 0; $i < 5; $i++) {
            Timeline::create([
                'center_id' => $centers[$i],
                'department_id' => $departments[$i],
                'position_id' => $positions[$i],
                'employee_id' => $employees[$i],
                'start_date' => $faker->date(),
                'end_date' => null,
                'created_by' => $faker->name,
                'updated_by' => $faker->name,
                'deleted_by' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]);
        }
    }
}
