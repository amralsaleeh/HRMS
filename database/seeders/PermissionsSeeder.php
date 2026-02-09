<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the "view logs" permission and assign it to the Admin role.
     */
    public function run(): void
    {
        $permission = Permission::firstOrCreate(
            ['name' => 'view logs', 'guard_name' => 'web']
        );

        $adminRole = Role::firstWhere('name', 'Admin');
        if ($adminRole) {
            $adminRole->givePermissionTo($permission);
        }
    }
}
