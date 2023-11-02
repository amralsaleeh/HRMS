<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
