<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireMiscActionsTest extends TestCase
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

    public function test_dashboard_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Dashboard::class)->assertStatus(200);
    }

    public function test_contact_us_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\ContactUs::class)->assertStatus(200);
    }

    public function test_maintenance_mode_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\MaintenanceMode::class)->assertStatus(200);
    }

    public function test_coming_soon_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Misc\ComingSoon::class)->assertStatus(200);
    }

    public function test_settings_users_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Settings\Users::class)->assertStatus(200);
    }

    public function test_settings_roles_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Settings\Roles::class)->assertStatus(200);
    }

    public function test_settings_permissions_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Settings\Permissions::class)->assertStatus(200);
    }

    public function test_assets_categories_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Assets\Categories::class)->assertStatus(200);
    }

    public function test_assets_inventory_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\Assets\Inventory::class)->assertStatus(200);
    }

    public function test_statistics_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\HumanResource\Statistics::class)->assertStatus(200);
    }

    public function test_discounts_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\HumanResource\Discounts::class)->assertStatus(200);
    }

    public function test_employees_structure_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)->assertStatus(200);
    }
}
