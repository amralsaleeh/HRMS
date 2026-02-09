<?php

namespace Database\Factories;

use App\Models\Leave;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    protected $model = Leave::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Annual', 'Sick', 'Unpaid', 'Maternity', 'Paternity']),
            'discount_rate' => fake()->numberBetween(0, 100),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
