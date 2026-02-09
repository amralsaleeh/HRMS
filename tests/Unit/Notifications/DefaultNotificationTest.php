<?php

namespace Tests\Unit\Notifications;

use App\Models\Employee;
use App\Models\User;
use App\Notifications\DefaultNotification;
use Database\Seeders\RolesSeeder;
use Tests\TestCase;

class DefaultNotificationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    public function test_via_returns_database(): void
    {
        $notification = new DefaultNotification(1, 'Test message');
        $notifiable = new User;

        $this->assertSame(['database'], $notification->via($notifiable));
    }

    public function test_to_array_returns_user_employee_id_image_message(): void
    {
        $employee = Employee::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
        $user = User::factory()->create([
            'employee_id' => $employee->id,
        ]);
        $user->setRelation('employee', $employee);

        $notification = new DefaultNotification($user->id, 'Discounts calculated.');
        $array = $notification->toArray($user);

        $this->assertSame('John Doe', $array['user']);
        $this->assertSame($user->employee_id, $array['employee_id']);
        $this->assertArrayHasKey('image', $array);
        $this->assertSame('Discounts calculated.', $array['message']);
    }

    public function test_to_array_uses_user_find_when_notifiable_different(): void
    {
        $employee = Employee::factory()->create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
        ]);
        $user = User::factory()->create([
            'employee_id' => $employee->id,
        ]);

        $notification = new DefaultNotification($user->id, 'Done.');
        $notifiable = new User;
        $array = $notification->toArray($notifiable);

        $this->assertSame('Jane Smith', $array['user']);
        $this->assertSame($user->employee_id, $array['employee_id']);
        $this->assertSame('Done.', $array['message']);
    }
}
