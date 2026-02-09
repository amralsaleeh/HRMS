<?php

namespace Database\Factories;

use App\Models\Contract;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    protected $model = Contract::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Full-time', 'Part-time', 'Contract', 'Temporary']),
            'work_rate' => fake()->randomFloat(2, 0.5, 1),
            'notes' => fake()->optional(0.3)->sentence(),
        ];
    }
}
