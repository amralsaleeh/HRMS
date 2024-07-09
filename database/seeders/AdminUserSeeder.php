<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'employee_id' => '1',
            'email' => 'admin@demo.com',
            'password' => bcrypt('admin'),
            'profile_photo_path' => 'profile-photos/.default-photo.jpg',
        ]);
    }
}
