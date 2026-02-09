<?php

namespace Tests\Feature;

use App\Models\Position;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewirePositionsTest extends TestCase
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

    public function test_positions_component_renders(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Positions::class)
            ->assertStatus(200);
    }

    public function test_can_add_position(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Positions::class)
            ->set('name', 'Developer')
            ->set('vacanciesCount', 2)
            ->call('addPosition');

        $this->assertDatabaseHas('positions', ['name' => 'Developer']);
    }

    public function test_add_position_validation_requires_name(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Positions::class)
            ->set('name', '')
            ->call('addPosition')
            ->assertHasErrors(['name']);
    }

    public function test_can_edit_position(): void
    {
        $this->actingAs($this->admin());
        $position = Position::factory()->create(['name' => 'Analyst']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Positions::class)
            ->call('showEditPositionModal', $position)
            ->set('name', 'Senior Analyst')
            ->call('editPosition');

        $this->assertDatabaseHas('positions', ['id' => $position->id, 'name' => 'Senior Analyst']);
    }

    public function test_can_delete_position(): void
    {
        $this->actingAs($this->admin());
        $position = Position::factory()->create(['name' => 'To Delete']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Positions::class)
            ->call('deletePosition', $position);

        $this->assertSoftDeleted('positions', ['id' => $position->id]);
    }
}
