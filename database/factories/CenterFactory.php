<?php

namespace Database\Factories;

use App\Models\Center;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Center>
 */
class CenterFactory extends Factory
{
    protected $model = Center::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'start_work_hour' => '08:00:00',
            'end_work_hour' => '17:00:00',
            'weekends' => [5, 6], // Saturday, Sunday (setter expects array)
        ];
    }
}
