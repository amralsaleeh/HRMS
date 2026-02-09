<?php

namespace Tests\Unit\Actions;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Tests\TestCase;

class CreateNewUserTest extends TestCase
{

    public function test_creates_user_with_valid_input(): void
    {
        $action = new CreateNewUser;

        $user = $action->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertSame('Test User', $user->name);
        $this->assertSame('test@example.com', $user->email);
        $this->assertTrue(password_verify('Password123!', $user->password));
    }

    public function test_creation_validates_unique_email(): void
    {
        $action = new CreateNewUser;
        $action->create([
            'name' => 'First User',
            'email' => 'existing@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $action->create([
            'name' => 'Another User',
            'email' => 'existing@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ]);
    }
}
