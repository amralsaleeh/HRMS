<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    private const GUARD = 'web';

    /** Role names used in routes and menu. */
    private const ROLES = [
        'Admin',
        'AM',
        'CC',
        'CR',
        'HR',
        'Employee',
        'Viewer',
    ];

    /**
     * Create all application roles with guard_name 'web'.
     */
    public function run(): void
    {
        foreach (self::ROLES as $name) {
            Role::firstOrCreate(
                ['name' => $name, 'guard_name' => self::GUARD],
                ['name' => $name, 'guard_name' => self::GUARD]
            );
        }
    }
}
