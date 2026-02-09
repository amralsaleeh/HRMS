<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    private const GUARD = 'web';

    /**
     * Create all permissions and assign them to roles.
     * Permission names are read from config so the settings UI can protect them from edit/delete.
     */
    public function run(): void
    {
        $permissions = config('permission.seeded_permission_names', []);

        foreach ($permissions as $name) {
            Permission::firstOrCreate(
                ['name' => $name, 'guard_name' => self::GUARD],
                ['name' => $name, 'guard_name' => self::GUARD]
            );
        }

        $allPermissions = collect($permissions);

        $admin = Role::firstWhere('name', 'Admin');
        if ($admin) {
            $admin->syncPermissions($allPermissions->toArray());
        }

        $hr = Role::firstWhere('name', 'HR');
        if ($hr) {
            $hr->syncPermissions([
                'view logs',
                'create employees',
                'create fingerprints',
                'create leaves',
                'view leaves',
                'read sms',
                'import leaves',
            ]);
        }

        $cc = Role::firstWhere('name', 'CC');
        if ($cc) {
            $cc->syncPermissions([
                'create leaves',
                'view leaves',
                'read sms',
                'import leaves',
            ]);
        }

        $cr = Role::firstWhere('name', 'CR');
        if ($cr) {
            $cr->syncPermissions(['view leaves']);
        }
    }
}
