<?php

namespace Tests\Feature;

use App\Models\Center;
use App\Models\Holiday;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireHolidaysTest extends TestCase
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

    public function test_holidays_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\HumanResource\Holidays::class)->assertStatus(200);
    }

    public function test_can_add_holiday(): void
    {
        $this->actingAs($this->admin());
        $center = Center::factory()->create();

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->set('name', 'Eid Holiday')
            ->set('centers', [$center->id])
            ->set('fromDate', '2024-04-10')
            ->set('toDate', '2024-04-12')
            ->set('note', 'Optional note')
            ->call('addHoliday');

        $this->assertDatabaseHas('holidays', ['name' => 'Eid Holiday', 'from_date' => '2024-04-10', 'to_date' => '2024-04-12']);
    }

    public function test_add_holiday_validation_requires_name(): void
    {
        $this->actingAs($this->admin());
        $center = Center::factory()->create();

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->set('name', '')
            ->set('centers', [$center->id])
            ->set('fromDate', '2024-04-10')
            ->set('toDate', '2024-04-12')
            ->call('addHoliday')
            ->assertHasErrors(['name']);
    }

    public function test_can_edit_holiday(): void
    {
        $this->actingAs($this->admin());
        $center = Center::factory()->create();
        $holiday = Holiday::factory()->create(['name' => 'Original', 'from_date' => '2024-01-01', 'to_date' => '2024-01-02']);
        $holiday->centers()->attach($center->id, ['created_by' => 'System', 'updated_by' => 'System']);

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->call('showEditHolidayModal', $holiday)
            ->set('name', 'Updated Holiday')
            ->set('fromDate', '2024-01-03')
            ->set('toDate', '2024-01-04')
            ->call('editHoliday');

        $holiday->refresh();
        $this->assertSame('Updated Holiday', $holiday->name);
        $this->assertSame('2024-01-03', $holiday->from_date);
        $this->assertSame('2024-01-04', $holiday->to_date);
    }

    public function test_can_delete_holiday(): void
    {
        $this->actingAs($this->admin());
        $holiday = Holiday::factory()->create(['name' => 'To Delete']);

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->call('deleteHoliday', $holiday);

        $this->assertSoftDeleted('holidays', ['id' => $holiday->id]);
    }

    public function test_confirm_delete_holiday_sets_id(): void
    {
        $this->actingAs($this->admin());
        $holiday = Holiday::factory()->create();

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->call('confirmDeleteHoliday', $holiday->id)
            ->assertSet('confirmedId', $holiday->id);
    }

    public function test_show_new_holiday_modal_resets(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Holidays::class)
            ->set('name', 'X')
            ->set('fromDate', '2024-01-01')
            ->call('showNewHolidayModal')
            ->assertSet('name', null)
            ->assertSet('isEdit', false);
    }
}
