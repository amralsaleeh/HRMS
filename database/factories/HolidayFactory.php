<?php

namespace Database\Factories;

use App\Models\Holiday;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Holiday>
 */
class HolidayFactory extends Factory
{
    protected $model = Holiday::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $from = fake()->dateTimeBetween('now', '+1 year');
        $to = (clone $from)->modify('+' . fake()->numberBetween(1, 5) . ' days');

        return [
            'name' => fake()->randomElement(['National Day', 'Eid', 'New Year', 'Company Day']),
            'from_date' => $from->format('Y-m-d'),
            'to_date' => $to->format('Y-m-d'),
            'note' => fake()->optional(0.3)->sentence(),
        ];
    }
}
