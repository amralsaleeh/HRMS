<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeUserSeeder extends Seeder
{
    public function run()
    {
        $employees = Employee::where('is_active', 1)
            ->whereDoesntHave('user')
            ->get();

        foreach ($employees as $employee) {
            $user = User::create([
                'name' => $employee->first_name.' '.$employee->last_name,
                'employee_id' => $employee->id,
                'email' => $employee->national_number.'@namaa.sy',
                'password' => Hash::make($employee->national_number),
                'profile_photo_path' => 'profile-photos/'.$employee->id.'.jpg',
            ]);

            DB::table('model_has_roles')->insert([
                'role_id' => 7,
                'model_type' => User::class,
                'model_id' => $user->id,
            ]);
        }

        $this->command->info("User accounts have been successfully created for {$employees->count()} active employees.");
    }
}
