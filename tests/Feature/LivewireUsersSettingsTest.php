<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireUsersSettingsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    protected function admin(): User
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        return $user;
    }

    public function test_users_component_renders(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\Settings\Users::class)
            ->assertStatus(200);
    }

    public function test_settings_users_page_contains_avatar_column(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get(route('settings-users'));

        $response->assertStatus(200);
        $response->assertSee(__('Avatar'), false);
        $response->assertSee(__('ID'), false);
        $response->assertSee(__('Name'), false);
    }
}
