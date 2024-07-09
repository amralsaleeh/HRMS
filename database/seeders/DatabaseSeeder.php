<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ContractsSeeder::class,
            EmployeesSeeder::class,

            AdminUserSeeder::class,

            CenterSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            TimelineSeeder::class,
        ]);

        if (file_exists('database/seeders/SettingsSeeder.php')) {
            $this->call([
                SettingsSeeder::class,
            ]);
        }

        // Create role
        $adminRole = Role::create(['name' => 'Admin']);

        // Assign role
        $admin = User::find(1);
        $admin->assignRole($adminRole);
    }
}
