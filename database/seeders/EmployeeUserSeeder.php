<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::where('is_active', 1)
            ->whereDoesntHave('user')
            ->get();

        foreach ($employees as $employee) {
            $user = User::create([
                'name' => $employee->first_name . ' ' . $employee->last_name,
                'employee_id' => $employee->id,
                'username' => $employee->id,
                'email' => $employee->national_number . '@namaa.sy',
                'password' => Hash::make($employee->national_number),
                'profile_photo_path' => 'profile-photos/' . $employee->id . '.jpg',
            ]);

            $user->assignRole('Employee');
        }

        $this->command->info("User accounts have been successfully created for {$employees->count()} active employees.");
    }
}
