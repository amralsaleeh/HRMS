<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Tests\TestCase;

class RoleBasedAccessTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_with_admin_role_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_with_admin_role_can_access_structure_centers(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Admin');

        $response = $this->actingAs($user)->get(route('structure-centers'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_with_hr_role_can_access_structure_centers(): void
    {
        $user = User::factory()->create();
        $user->assignRole('HR');

        $response = $this->actingAs($user)->get(route('structure-centers'));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_without_structure_role_cannot_access_structure_centers(): void
    {
        $user = User::factory()->create();
        $user->assignRole('Employee');

        $response = $this->actingAs($user)->get(route('structure-centers'));

        $response->assertStatus(403);
    }
}
