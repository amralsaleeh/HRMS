<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Department;
use App\Models\Timeline;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Departments extends Component
{
    // Variables - Start //
    public $departments = [];

    #[Rule('required')]
    public $name;

    public $department;

    public $isEdit = false;

    public $confirmedId;
    // Variables - End //

    public function render()
    {
        $this->departments = Department::all();

        return view('livewire.human-resource.structure.departments');
    }

    public function submitDepartment()
    {
        $this->isEdit ? $this->editDepartment() : $this->addDepartment();
    }

    public function addDepartment()
    {
        $this->validate();

        Department::create([
            'name' => $this->name,
        ]);

        $this->dispatch('closeModal', elementId: '#departmentModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function editDepartment()
    {
        $this->validate();

        $this->department->update([
            'name' => $this->name,
        ]);

        $this->dispatch('closeModal', elementId: '#departmentModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset();
    }

    public function confirmDeleteDepartment($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteDepartment(Department $department)
    {
        $department->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showNewDepartmentModal()
    {
        $this->reset();
    }

    public function showEditDepartmentModal(Department $department)
    {
        $this->reset();
        $this->isEdit = true;

        $this->department = $department;

        $this->name = $department->name;
    }

    public function getCoordinator($id)
    {
        //
    }

    public function getMembersCount($department_id)
    {
        return Timeline::where('department_id', $department_id)
            ->whereNull('end_date')
            ->distinct('employee_id')
            ->count();
    }
}
