<?php

namespace Database\Seeders;

use App\Models\Department;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Department::create([
                'name' => $faker->firstName,
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
