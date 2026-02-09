<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireBulkTest extends TestCase
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

    public function test_bulk_component_renders(): void
    {
        $this->actingAs($this->admin());
        Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)->assertStatus(200);
    }

    public function test_validate_numbers_fails_when_message_empty(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)
            ->set('messageText', '')
            ->set('numbersInput', "933697861\n933697862")
            ->call('validateNumbers')
            ->assertSet('validated', false);
    }

    public function test_validate_numbers_succeeds_with_valid_input(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)
            ->set('messageText', 'Hello')
            ->set('numbersInput', "933697861")
            ->call('validateNumbers')
            ->assertSet('validated', true)
            ->assertSet('numbers', ['963933697861;']);
    }

    public function test_validate_numbers_rejects_invalid_number_format(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)
            ->set('messageText', 'Hello')
            ->set('numbersInput', "123")
            ->call('validateNumbers')
            ->assertSet('validated', false);
    }

    public function test_validate_numbers_rejects_duplicate_numbers(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)
            ->set('messageText', 'Hello')
            ->set('numbersInput', "933697861\n933697861")
            ->call('validateNumbers')
            ->assertSet('validated', false);
    }

    public function test_changing_numbers_input_after_validate_clears_validated(): void
    {
        $this->actingAs($this->admin());

        $component = Livewire::test(\App\Livewire\HumanResource\Messages\Bulk::class)
            ->set('messageText', 'Hi')
            ->set('numbersInput', '933697861')
            ->call('validateNumbers');
        $component->assertSet('validated', true);

        $component->set('numbersInput', '933697862');
        $component->assertSet('validated', false);
        $component->assertSet('numbers', []);
    }
}
