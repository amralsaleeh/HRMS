<?php

namespace Database\Seeders;

use App\Models\Center;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Center::create([
                'name' => $faker->firstName,
                'start_work_hour' => $faker->time(),
                'end_work_hour' => $faker->time(),
                'weekends' => $faker->words(),
                'is_active' => rand(0, 1),
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
