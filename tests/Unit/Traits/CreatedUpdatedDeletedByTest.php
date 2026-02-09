<?php

namespace Tests\Unit\Traits;

use App\Models\Department;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Tests\TestCase;

class CreatedUpdatedDeletedByTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }

    public function test_creating_sets_created_by_and_updated_by_when_authenticated(): void
    {
        $user = User::factory()->create(['name' => 'Test User']);
        $this->actingAs($user);

        $department = Department::create(['name' => 'IT']);

        $this->assertSame('Test User', $department->created_by);
        $this->assertSame('Test User', $department->updated_by);
    }

    public function test_creating_sets_system_when_not_authenticated(): void
    {
        $department = Department::create(['name' => 'HR']);

        $this->assertSame('System', $department->created_by);
        $this->assertSame('System', $department->updated_by);
    }

    public function test_updating_sets_updated_by_when_authenticated(): void
    {
        $user = User::factory()->create(['name' => 'Updater']);
        $this->actingAs($user);
        $department = Department::create(['name' => 'Sales']);
        $department->update(['name' => 'Sales & Marketing']);
        $this->assertSame('Updater', $department->fresh()->updated_by);
    }

    public function test_updating_sets_system_when_not_authenticated(): void
    {
        $department = Department::create(['name' => 'Support']);
        $department->update(['name' => 'Support & Help']);

        $this->assertSame('System', $department->fresh()->updated_by);
    }

    public function test_deleting_sets_deleted_by_when_authenticated(): void
    {
        $user = User::factory()->create(['name' => 'Deleter']);
        $this->actingAs($user);
        $department = Department::create(['name' => 'To Delete']);
        $department->delete();

        $this->assertSame('Deleter', $department->fresh()->deleted_by);
    }

    public function test_deleting_sets_system_when_not_authenticated(): void
    {
        $department = Department::create(['name' => 'To Remove']);
        $department->delete();

        $this->assertSame('System', $department->fresh()->deleted_by);
    }

    public function test_creating_does_not_overwrite_explicit_created_by(): void
    {
        $user = User::factory()->create(['name' => 'User']);
        $this->actingAs($user);

        $department = new Department(['name' => 'Explicit']);
        $department->created_by = 'Custom';
        $department->updated_by = 'Custom';
        $department->save();

        $this->assertSame('Custom', $department->created_by);
        $this->assertSame('Custom', $department->updated_by);
    }

    public function test_updating_does_not_overwrite_explicit_updated_by(): void
    {
        $user = User::factory()->create(['name' => 'User']);
        $this->actingAs($user);
        $department = Department::create(['name' => 'Dept']);
        $department->updated_by = 'Manual';
        $department->name = 'Dept Updated';
        $department->save();
        $this->assertSame('Manual', $department->fresh()->updated_by);
    }
}
