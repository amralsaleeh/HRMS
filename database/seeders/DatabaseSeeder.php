<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        // Create all roles (Admin, AM, CC, CR, HR, Employee, Viewer)
        $this->call(RolesSeeder::class);

        // Assign Admin role to default admin user
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole('Admin');
        }

        $this->call(PermissionsSeeder::class);
    }
}
