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
            'email' => 'admin@namaa.sy',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Test',
            'email' => 'test@namaa.sy',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Info',
            'email' => 'info@namaa.sy',
            'password' => bcrypt('12345678'),
        ]);
    }
}
