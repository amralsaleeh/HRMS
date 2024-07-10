<?php

namespace Database\Seeders;

use App\Models\Employee;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            Employee::create([
                'contract_id' => rand(1, 2),
                'first_name' => $faker->firstName,
                'father_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'mother_name' => $faker->lastName,
                'birth_and_place' => $faker->address,
                'national_number' => $faker->unique()->numerify('########'),
                'mobile_number' => $faker->unique()->numerify('##########'),
                'degree' => $faker->word,
                'gender' => rand(0, 1),
                'address' => $faker->address,
                'notes' => $faker->text,
                'max_leave_allowed' => rand(0, 30),
                'delay_counter' => '00:00:00',
                'hourly_counter' => '00:00:00',
                'is_active' => rand(0, 1),
                'profile_photo_path' => 'profile-photos/.default-photo.jpg',
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
