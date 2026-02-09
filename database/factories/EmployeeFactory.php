<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contract_id' => Contract::factory(),
            'first_name' => fake()->firstName(),
            'father_name' => fake()->firstName('male'),
            'last_name' => fake()->lastName(),
            'mother_name' => fake()->firstName('female'),
            'birth_and_place' => fake()->city() . ', ' . fake()->country(),
            'national_number' => fake()->unique()->numerify('##########'),
            'mobile_number' => fake()->unique()->numerify('05########'),
            'degree' => fake()->randomElement(['Bachelor', 'Master', 'PhD', 'Diploma']),
            'gender' => fake()->boolean(),
            'address' => fake()->address(),
            'notes' => fake()->optional(0.2)->sentence(),
            'balance_leave_allowed' => fake()->numberBetween(0, 30),
            'max_leave_allowed' => fake()->numberBetween(21, 30),
            'delay_counter' => '00:00:00',
            'hourly_counter' => '00:00:00',
            'is_active' => true,
            'profile_photo_path' => '',
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => ['is_active' => false]);
    }
}
