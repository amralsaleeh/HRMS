<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Employee;
use App\Models\Timeline;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;

    // 👉 Variables

    public $employee;

    public $searchTerm = null;

    public $isEdit = false;

    public $confirmedId;

    // Information
    public $id;

    public $contract_id;

    public $first_name;

    public $father_name;

    public $last_name;

    public $mother_name;

    public $birth_and_place;

    public $national_number;

    public $mobile_number;

    public $degree;

    public $gender;

    public $address;

    public $notes;

    public $max_leave_allowed;

    public $delay_counter;

    public $hourly_counter;

    public $is_active;

    public function render()
    {
        $employees = Employee::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('first_name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('last_name', 'like', '%'.$this->searchTerm.'%')
            ->paginate(20);

        return view('livewire.human-resource.structure.employees', [
            'employees' => $employees,
        ]);
    }

    public function showNewEmployeeModal()
    {
        $this->reset();
    }

    public function showEditEmployeeModal(Employee $employee)
    {
        $this->reset();
        $this->isEdit = true;

        $this->employee = $employee;
        $this->contract_id = $employee->contract_id;
        $this->first_name = $employee->first_name;
        $this->father_name = $employee->father_name;
        $this->last_name = $employee->last_name;
        $this->mother_name = $employee->mother_name;
        $this->birth_and_place = $employee->birth_and_place;
        $this->national_number = $employee->national_number;
        $this->mobile_number = $employee->mobile_number;
        $this->mobile_number = $employee->mobile_number;
        $this->degree = $employee->degree;
        $this->gender = $employee->gender;
        $this->address = $employee->address;
        $this->notes = $employee->notes;
        $this->max_leave_allowed = $employee->max_leave_allowed;
        $this->is_active = $employee->is_active;
    }

    public function submitEmployee()
    {
        $this->isEdit ? $this->editEmployee() : $this->addEmployee();
    }

    public function addEmployee()
    {
        Employee::create([
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'first_name' => $this->first_name,
            'father_name' => $this->father_name,
            'last_name' => $this->last_name,
            'mother_name' => $this->mother_name,
            'birth_and_place' => $this->birth_and_place,
            'national_number' => $this->national_number,
            'mobile_number' => $this->mobile_number,
            'degree' => $this->degree,
            'gender' => $this->gender,
            'address' => $this->address,
            'notes' => $this->notes,
            'max_leave_allowed' => $this->max_leave_allowed,
            // 'delay_counter' => $this->delay_counter,
            // 'hourly_counter' => $this->hourly_counter,
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('closeModal', elementId: '#employeeModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }

    public function editEmployee()
    {
        $this->employee->update([
            'id' => $this->id,
            'contract_id' => $this->contract_id,
            'first_name' => $this->first_name,
            'father_name' => $this->father_name,
            'last_name' => $this->last_name,
            'mother_name' => $this->mother_name,
            'birth_and_place' => $this->birth_and_place,
            'national_number' => $this->national_number,
            'mobile_number' => $this->mobile_number,
            'degree' => $this->degree,
            'gender' => $this->gender,
            'address' => $this->address,
            'notes' => $this->notes,
            'max_leave_allowed' => $this->max_leave_allowed,
            // 'delay_counter' => $this->delay_counter,
            // 'hourly_counter' => $this->hourly_counter,
            'is_active' => $this->is_active,
        ]);

        $this->dispatch('closeModal', elementId: '#employeeModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');

        $this->reset();
    }

    public function confirmDeleteEmployee($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }

    public function getCoordinator($id)
    {
        //
    }

    public function getMembersCount($employee_id)
    {
        return Timeline::where('Employee_id', $employee_id)
            ->whereNull('end_date')
            ->distinct('employee_id')
            ->count();
    }
}
