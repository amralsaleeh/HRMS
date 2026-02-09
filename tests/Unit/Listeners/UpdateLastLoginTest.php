<?php

namespace Tests\Unit\Listeners;

use App\Models\User;
use App\Listeners\UpdateLastLogin;
use Illuminate\Auth\Events\Login;
use Tests\TestCase;

class UpdateLastLoginTest extends TestCase
{

    public function test_handle_updates_user_last_login(): void
    {
        $user = User::factory()->create([
            'last_login' => null,
        ]);
        $event = new Login('web', $user, false);
        $listener = new UpdateLastLogin;

        $listener->handle($event);

        $user->refresh();
        $this->assertNotNull($user->last_login);
        $this->assertTrue(\Carbon\Carbon::parse($user->last_login)->isToday());
    }

    public function test_handle_uses_save_quietly(): void
    {
        $user = User::factory()->create();
        $event = new Login('web', $user, false);
        $listener = new UpdateLastLogin;

        $listener->handle($event);

        $this->assertNotNull($user->fresh()->last_login);
    }
}
