<?php

namespace Tests\Feature;

use App\Models\Center;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireCentersTest extends TestCase
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

    public function test_centers_component_renders(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Centers::class)
            ->assertStatus(200);
    }

    public function test_can_add_center(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Centers::class)
            ->set('name', 'Test Center')
            ->set('startWorkHour', '08:00')
            ->set('endWorkHour', '17:00')
            ->set('weekends', [5, 6])
            ->call('addCenter');

        $this->assertDatabaseHas('centers', [
            'name' => 'Test Center',
        ]);
        $center = Center::where('name', 'Test Center')->first();
        $this->assertSame('08:00', $center->start_work_hour);
        $this->assertSame('17:00', $center->end_work_hour);
    }

    public function test_add_center_validation_requires_name(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Centers::class)
            ->set('name', '')
            ->set('startWorkHour', '08:00')
            ->set('endWorkHour', '17:00')
            ->set('weekends', [5, 6])
            ->call('addCenter')
            ->assertHasErrors(['name']);
    }

    public function test_can_delete_center(): void
    {
        $this->actingAs($this->admin());
        $center = Center::factory()->create(['name' => 'To Delete']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Centers::class)
            ->call('deleteCenter', $center);

        $this->assertSoftDeleted('centers', ['id' => $center->id]);
    }

    public function test_can_edit_center(): void
    {
        $this->actingAs($this->admin());
        $center = Center::factory()->create(['name' => 'Original Name', 'weekends' => [5, 6]]);

        Livewire::test(\App\Livewire\HumanResource\Structure\Centers::class)
            ->call('showEditCenterModal', $center)
            ->set('name', 'Updated Name')
            ->set('startWorkHour', '09:00')
            ->set('endWorkHour', '18:00')
            ->set('weekends', [4, 5])
            ->call('editCenter');

        $center->refresh();
        $this->assertSame('Updated Name', $center->name);
        $this->assertSame('09:00', $center->start_work_hour);
        $this->assertSame('18:00', $center->end_work_hour);
    }
}
