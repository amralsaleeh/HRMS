<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{

    public function test_employee_full_name_when_employee_exists(): void
    {
        $employee = Employee::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
        $user = User::factory()->create(['employee_id' => $employee->id]);
        $user->setRelation('employee', $employee);

        $this->assertSame('John Doe', $user->EmployeeFullName);
    }

    public function test_employee_full_name_when_no_employee(): void
    {
        $user = User::factory()->create(['employee_id' => null]);

        $this->assertSame('', $user->EmployeeFullName);
    }

    public function test_profile_photo_url_returns_default_when_no_path(): void
    {
        $user = User::factory()->create(['profile_photo_path' => null]);

        $this->assertStringContainsString('/storage/', $user->profile_photo_url);
        $this->assertStringContainsString('profile-photos', $user->profile_photo_url);
    }

    public function test_profile_photo_url_returns_default_when_path_is_default(): void
    {
        $user = User::factory()->create([
            'profile_photo_path' => 'profile-photos/.default-photo.jpg',
        ]);

        $this->assertStringContainsString('/storage/profile-photos/', $user->profile_photo_url);
    }

    public function test_employee_relationship(): void
    {
        $employee = Employee::factory()->create();
        $user = User::factory()->create(['employee_id' => $employee->id]);

        $this->assertInstanceOf(Employee::class, $user->employee);
        $this->assertSame($employee->id, $user->employee->id);
    }
}
