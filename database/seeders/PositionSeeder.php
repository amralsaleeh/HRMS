<?php

namespace Database\Seeders;

use App\Models\Position;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Position::create([
                'name' => $faker->firstName,
                'vacancies_count' => rand(1, 10),
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
