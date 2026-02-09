<?php

namespace Tests\Feature;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireEmployeesTest extends TestCase
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

    /** @return array<string, mixed> */
    protected function validEmployeeInfo(int $id = 88888): array
    {
        $contract = Contract::factory()->create();

        return [
            'id' => $id,
            'contractId' => $contract->id,
            'firstName' => 'Test',
            'fatherName' => 'Father',
            'lastName' => 'Employee',
            'motherName' => 'Mother',
            'birthAndPlace' => 'Damascus, Syria',
            'nationalNumber' => '02000000000',
            'mobileNumber' => '900000001',
            'degree' => 'Bachelor',
            'gender' => 1,
            'address' => '123 Test St',
            'notes' => null,
        ];
    }

    public function test_employees_component_renders(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->assertStatus(200);
    }

    public function test_structure_employees_page_contains_avatar_and_name_columns(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get(route('structure-employees'));

        $response->assertStatus(200);
        $response->assertSee(__('Avatar'), false);
        $response->assertSee(__('Name'), false);
        $response->assertSee('ti-dots-vertical', false);
    }

    public function test_can_add_employee_without_photo(): void
    {
        $this->actingAs($this->admin());
        $info = $this->validEmployeeInfo(88881);

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->set('employeeInfo.id', $info['id'])
            ->set('employeeInfo.contractId', $info['contractId'])
            ->set('employeeInfo.firstName', $info['firstName'])
            ->set('employeeInfo.fatherName', $info['fatherName'])
            ->set('employeeInfo.lastName', $info['lastName'])
            ->set('employeeInfo.motherName', $info['motherName'])
            ->set('employeeInfo.birthAndPlace', $info['birthAndPlace'])
            ->set('employeeInfo.nationalNumber', $info['nationalNumber'])
            ->set('employeeInfo.mobileNumber', $info['mobileNumber'])
            ->set('employeeInfo.degree', $info['degree'])
            ->set('employeeInfo.gender', $info['gender'])
            ->set('employeeInfo.address', $info['address'])
            ->set('employeeInfo.notes', $info['notes'])
            ->call('submitEmployee')
            ->assertRedirect(route('structure-employees-info', ['id' => $info['id']]));

        $this->assertDatabaseHas('employees', [
            'id' => $info['id'],
            'first_name' => 'Test',
            'last_name' => 'Employee',
        ]);
        $employee = Employee::find($info['id']);
        $this->assertNotNull($employee);
        $defaultPath = config('app.default_profile_photo_path', 'profile-photos/.default-photo.jpg');
        $this->assertSame($defaultPath, $employee->profile_photo_path);
    }

    public function test_can_add_employee_with_photo(): void
    {
        Storage::fake('public');
        $this->actingAs($this->admin());
        $info = $this->validEmployeeInfo(88882);
        $file = UploadedFile::fake()->image('avatar.jpg', 100, 100);

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->set('employeeInfo.id', $info['id'])
            ->set('employeeInfo.contractId', $info['contractId'])
            ->set('employeeInfo.firstName', $info['firstName'])
            ->set('employeeInfo.fatherName', $info['fatherName'])
            ->set('employeeInfo.lastName', $info['lastName'])
            ->set('employeeInfo.motherName', $info['motherName'])
            ->set('employeeInfo.birthAndPlace', $info['birthAndPlace'])
            ->set('employeeInfo.nationalNumber', $info['nationalNumber'])
            ->set('employeeInfo.mobileNumber', $info['mobileNumber'])
            ->set('employeeInfo.degree', $info['degree'])
            ->set('employeeInfo.gender', $info['gender'])
            ->set('employeeInfo.address', $info['address'])
            ->set('employeeInfo.notes', $info['notes'])
            ->set('photo', $file)
            ->call('submitEmployee')
            ->assertRedirect(route('structure-employees-info', ['id' => $info['id']]));

        $employee = Employee::find($info['id']);
        $this->assertNotNull($employee);
        $this->assertStringStartsWith('profile-photos/', $employee->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($employee->profile_photo_path));
    }

    public function test_add_employee_validation_requires_required_fields(): void
    {
        $this->actingAs($this->admin());

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->set('employeeInfo.id', 88883)
            ->set('employeeInfo.contractId', Contract::factory()->create()->id)
            ->set('employeeInfo.firstName', '')
            ->set('employeeInfo.fatherName', 'F')
            ->set('employeeInfo.lastName', 'L')
            ->set('employeeInfo.motherName', 'M')
            ->set('employeeInfo.birthAndPlace', 'Place')
            ->set('employeeInfo.nationalNumber', '02000000001')
            ->set('employeeInfo.mobileNumber', '900000002')
            ->set('employeeInfo.degree', 'Bachelor')
            ->set('employeeInfo.gender', 1)
            ->set('employeeInfo.address', 'Address')
            ->call('submitEmployee')
            ->assertHasErrors(['employeeInfo.firstName']);
    }

    public function test_can_edit_employee_without_photo(): void
    {
        $this->actingAs($this->admin());
        $employee = Employee::factory()->create([
            'first_name' => 'Original',
            'last_name' => 'Name',
            'national_number' => '02000000011',
            'mobile_number' => '900000011',
            'profile_photo_path' => config('app.default_profile_photo_path', 'profile-photos/.default-photo.jpg'),
        ]);

        $component = Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->call('showEditEmployeeModal', $employee);

        $info = $component->get('employeeInfo');
        $info['firstName'] = 'Updated';
        $info['lastName'] = 'Surname';

        $component->set('employeeInfo', $info)->call('submitEmployee');

        $employee->refresh();
        $this->assertSame('Updated', $employee->first_name);
        $this->assertSame('Surname', $employee->last_name);
    }

    public function test_can_edit_employee_with_photo(): void
    {
        Storage::fake('public');
        $this->actingAs($this->admin());
        $employee = Employee::factory()->create([
            'national_number' => '02000000012',
            'mobile_number' => '900000012',
            'profile_photo_path' => config('app.default_profile_photo_path', 'profile-photos/.default-photo.jpg'),
        ]);
        $file = UploadedFile::fake()->image('new-avatar.jpg', 100, 100);

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->call('showEditEmployeeModal', $employee)
            ->set('photo', $file)
            ->call('submitEmployee');

        $employee->refresh();
        $this->assertStringStartsWith('profile-photos/', $employee->profile_photo_path);
        $this->assertTrue(Storage::disk('public')->exists($employee->profile_photo_path));
    }

    public function test_can_delete_employee(): void
    {
        $this->actingAs($this->admin());
        $employee = Employee::factory()->create(['first_name' => 'To Delete']);

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->call('deleteEmployee', $employee);

        $this->assertSoftDeleted('employees', ['id' => $employee->id]);
    }

    public function test_show_create_modal_resets_state(): void
    {
        $this->actingAs($this->admin());
        $employee = Employee::factory()->create();

        $component = Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->call('showEditEmployeeModal', $employee)
            ->call('showCreateEmployeeModal');

        $this->assertFalse($component->get('isEdit'));
        $this->assertEmpty($component->get('employeeInfo'));
    }

    public function test_show_edit_modal_populates_employee_info(): void
    {
        $this->actingAs($this->admin());
        $employee = Employee::factory()->create([
            'first_name' => 'Edit',
            'last_name' => 'Me',
        ]);

        $component = Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->call('showEditEmployeeModal', $employee);

        $this->assertTrue($component->get('isEdit'));
        $this->assertSame($employee->id, $component->get('employeeInfo')['id']);
        $this->assertSame('Edit', $component->get('employeeInfo')['firstName']);
        $this->assertSame('Me', $component->get('employeeInfo')['lastName']);
    }

    public function test_photo_validation_rejects_oversized_image(): void
    {
        $this->actingAs($this->admin());
        $info = $this->validEmployeeInfo(88884);
        // Create an image larger than 1024 KB (1 MB) to fail max:1024 validation
        $file = UploadedFile::fake()->image('large.jpg', 1200, 1200)->size(2048);

        Livewire::test(\App\Livewire\HumanResource\Structure\Employees::class)
            ->set('employeeInfo.id', $info['id'])
            ->set('employeeInfo.contractId', $info['contractId'])
            ->set('employeeInfo.firstName', $info['firstName'])
            ->set('employeeInfo.fatherName', $info['fatherName'])
            ->set('employeeInfo.lastName', $info['lastName'])
            ->set('employeeInfo.motherName', $info['motherName'])
            ->set('employeeInfo.birthAndPlace', $info['birthAndPlace'])
            ->set('employeeInfo.nationalNumber', $info['nationalNumber'])
            ->set('employeeInfo.mobileNumber', $info['mobileNumber'])
            ->set('employeeInfo.degree', $info['degree'])
            ->set('employeeInfo.gender', $info['gender'])
            ->set('employeeInfo.address', $info['address'])
            ->set('employeeInfo.notes', $info['notes'])
            ->set('photo', $file)
            ->call('submitEmployee')
            ->assertHasErrors(['photo']);
    }
}
