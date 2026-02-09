<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireDepartmentsTest extends TestCase
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

    public function test_departments_component_renders(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->assertStatus(200);
    }

    public function test_can_add_department(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->set('name', 'Engineering')
            ->call('addDepartment');

        $this->assertDatabaseHas('departments', ['name' => 'Engineering']);
    }

    public function test_add_department_validation_requires_name(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->set('name', '')
            ->call('addDepartment')
            ->assertHasErrors(['name']);
    }

    public function test_can_edit_department(): void
    {
        $this->actingAs($this->admin());
        $department = Department::factory()->create(['name' => 'HR']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->call('showEditDepartmentModal', $department)
            ->set('name', 'Human Resources')
            ->call('editDepartment');

        $this->assertDatabaseHas('departments', ['id' => $department->id, 'name' => 'Human Resources']);
    }

    public function test_can_delete_department(): void
    {
        $this->actingAs($this->admin());
        $department = Department::factory()->create(['name' => 'To Delete']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->call('deleteDepartment', $department);

        $this->assertSoftDeleted('departments', ['id' => $department->id]);
    }

    public function test_get_members_count_can_be_called(): void
    {
        $this->actingAs($this->admin());
        $department = Department::factory()->create();

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->call('getMembersCount', $department->id)
            ->assertStatus(200);
    }

    public function test_get_coordinator_can_be_called(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->call('getCoordinator', 1)
            ->assertStatus(200);
    }

    public function test_show_new_department_modal_resets(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->set('name', 'X')
            ->call('showNewDepartmentModal')
            ->assertSet('name', null);
    }

    public function test_submit_department_calls_add_when_not_edit(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->set('isEdit', false)
            ->set('name', 'New Dept')
            ->call('submitDepartment');

        $this->assertDatabaseHas('departments', ['name' => 'New Dept']);
    }

    public function test_confirm_delete_department_sets_id(): void
    {
        $this->actingAs($this->admin());
        $department = Department::factory()->create();

        Livewire::test(\App\Livewire\HumanResource\Structure\Departments::class)
            ->call('confirmDeleteDepartment', $department->id)
            ->assertSet('confirmedId', $department->id);
    }
}
