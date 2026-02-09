<?php

namespace Database\Factories;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeline>
 */
class TimelineFactory extends Factory
{
    protected $model = Timeline::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'center_id' => Center::factory(),
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
            'employee_id' => Employee::factory(),
            'start_date' => fake()->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
            'end_date' => null,
            'notes' => fake()->optional(0.2)->sentence(),
        ];
    }
}
