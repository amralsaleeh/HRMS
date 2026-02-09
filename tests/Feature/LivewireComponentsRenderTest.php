<?php

namespace Tests\Feature;

use App\Livewire\HumanResource\Structure\EmployeeInfo;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireComponentsRenderTest extends TestCase
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

    /** @dataProvider livewireComponentProvider */
    public function test_component_renders(string $componentClass): void
    {
        $this->actingAs($this->admin());

        if ($componentClass === EmployeeInfo::class) {
            if (! Schema::hasColumn('timelines', 'is_sequent')) {
                $this->markTestSkipped('EmployeeInfo requires timelines.is_sequent column.');
            }
            $employee = Employee::factory()->create();
            Livewire::test($componentClass, ['id' => $employee->id])->assertStatus(200);
            return;
        }

        Livewire::test($componentClass)->assertStatus(200);
    }

    public static function livewireComponentProvider(): array
    {
        return [
            'Dashboard' => [\App\Livewire\Dashboard::class],
            'ContactUs' => [\App\Livewire\ContactUs::class],
            'MaintenanceMode' => [\App\Livewire\MaintenanceMode::class],
            'ComingSoon' => [\App\Livewire\Misc\ComingSoon::class],
            'Footer' => [\App\Livewire\Sections\Footer\Footer::class],
            'VerticalMenu' => [\App\Livewire\Sections\Menu\VerticalMenu::class],
            'Navbar' => [\App\Livewire\Sections\Navbar\Navbar::class],
            'Employees' => [\App\Livewire\HumanResource\Structure\Employees::class],
            'EmployeeInfo' => [\App\Livewire\HumanResource\Structure\EmployeeInfo::class],
            'Fingerprints' => [\App\Livewire\HumanResource\Attendance\Fingerprints::class],
            'Leaves' => [\App\Livewire\HumanResource\Attendance\Leaves::class],
            'Holidays' => [\App\Livewire\HumanResource\Holidays::class],
            'Discounts' => [\App\Livewire\HumanResource\Discounts::class],
            'Statistics' => [\App\Livewire\HumanResource\Statistics::class],
            'Bulk' => [\App\Livewire\HumanResource\Messages\Bulk::class],
            'Personal' => [\App\Livewire\HumanResource\Messages\Personal::class],
            'Users' => [\App\Livewire\Settings\Users::class],
            'Roles' => [\App\Livewire\Settings\Roles::class],
            'Permissions' => [\App\Livewire\Settings\Permissions::class],
            'Categories' => [\App\Livewire\Assets\Categories::class],
            'Inventory' => [\App\Livewire\Assets\Inventory::class],
        ];
    }
}
