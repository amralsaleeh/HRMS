<?php

namespace Tests\Unit\Models;

use App\Models\Employee;
use App\Models\Message;
use App\Models\User;
use Tests\TestCase;

class MessageTest extends TestCase
{

    public function test_employee_relationship(): void
    {
        $employee = Employee::factory()->create();
        $message = Message::create([
            'employee_id' => $employee->id,
            'text' => 'Test',
            'recipient' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertInstanceOf(Employee::class, $message->employee()->getRelated());
    }

    public function test_get_message_sender_photo_returns_storage_path_when_sender_exists(): void
    {
        $user = User::factory()->create(['name' => 'Admin', 'profile_photo_path' => 'profile-photos/avatar.jpg']);
        $employee = Employee::factory()->create();
        $message = Message::create([
            'employee_id' => $employee->id,
            'text' => 'Test',
            'recipient' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'Admin',
        ]);

        $photo = $message->getMessageSenderPhoto();

        $this->assertStringContainsString('storage/', $photo);
        $this->assertStringContainsString('profile-photos', $photo);
    }

    public function test_get_message_sender_photo_returns_default_when_sender_not_found(): void
    {
        $employee = Employee::factory()->create();
        $message = Message::create([
            'employee_id' => $employee->id,
            'text' => 'Test',
            'recipient' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'NonExistentUser',
        ]);

        $photo = $message->getMessageSenderPhoto();

        $this->assertSame('storage/profile-photos/.administrator.jpg', $photo);
    }
}
