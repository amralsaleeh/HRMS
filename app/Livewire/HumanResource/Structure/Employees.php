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

    public $employeeInfo = [];

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
        $this->employeeInfo['id'] = $employee->id;
        $this->employee = $employee;
        $this->employeeInfo['contract_id'] = $employee->contract_id;
        $this->employeeInfo['first_name'] = $employee->first_name;
        $this->employeeInfo['father_name'] = $employee->father_name;
        $this->employeeInfo['last_name'] = $employee->last_name;
        $this->employeeInfo['mother_name'] = $employee->mother_name;
        $this->employeeInfo['birth_and_place'] = $employee->birth_and_place;
        $this->employeeInfo['national_number'] = $employee->national_number;
        $this->employeeInfo['mobile_number'] = $employee->mobile_number;
        $this->employeeInfo['mobile_number'] = $employee->mobile_number;
        $this->employeeInfo['degree'] = $employee->degree;
        $this->employeeInfo['gender'] = $employee->gender;
        $this->employeeInfo['address'] = $employee->address;
        // $this->employeeInfo['notes'] = $employee->notes;
        $this->employeeInfo['max_leave_allowed'] = $employee->max_leave_allowed;
        $this->employeeInfo['is_active'] = $employee->is_active;
    }

    public function submitEmployee()
    {
        $this->isEdit ? $this->editEmployee() : $this->addEmployee();
    }

    public function addEmployee()
    {
        $this->validate([
            'employeeInfo.id' => 'required',
            'employeeInfo.contract_id' => 'required',
            'employeeInfo.first_name' => 'required',
            'employeeInfo.father_name' => 'required',
            'employeeInfo.last_name' => 'required',
            'employeeInfo.mother_name' => 'required',
            'employeeInfo.birth_and_place' => 'required',
            'employeeInfo.national_number' => 'required',
            'employeeInfo.mobile_number' => 'required',
            'employeeInfo.degree' => 'required',
            'employeeInfo.gender' => 'required',
            'employeeInfo.address' => 'required',
            'employeeInfo.max_leave_allowed' => 'required',
            'employeeInfo.is_active' => 'required',
        ]);

        Employee::create([
            'id' => $this->employeeInfo['id'],
            'contract_id' => $this->employeeInfo['contract_id'],
            'first_name' => $this->employeeInfo['first_name'],
            'father_name' => $this->employeeInfo['father_name'],
            'last_name' => $this->employeeInfo['last_name'],
            'mother_name' => $this->employeeInfo['mother_name'],
            'birth_and_place' => $this->employeeInfo['birth_and_place'],
            'national_number' => $this->employeeInfo['national_number'],
            'mobile_number' => $this->employeeInfo['mobile_number'],
            'degree' => $this->employeeInfo['degree'],
            'gender' => $this->employeeInfo['gender'],
            'address' => $this->employeeInfo['address'],
            // 'notes' => $this->employeeInfo['notes'],
            'max_leave_allowed' => $this->employeeInfo['max_leave_allowed'],
            // 'delay_counter' => $this->delay_counter,
            // 'hourly_counter' => $this->hourly_counter,
            'is_active' => $this->employeeInfo['is_active'],
        ]);

        $this->dispatch('closeModal', elementId: '#employeeModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }

    public function editEmployee()
    {
        $this->isEdit = true;

        $this->validate([
            'employeeInfo.id' => 'required',
            'employeeInfo.contract_id' => 'required',
            'employeeInfo.first_name' => 'required',
            'employeeInfo.father_name' => 'required',
            'employeeInfo.last_name' => 'required',
            'employeeInfo.mother_name' => 'required',
            'employeeInfo.birth_and_place' => 'required',
            'employeeInfo.national_number' => 'required',
            'employeeInfo.mobile_number' => 'required',
            'employeeInfo.degree' => 'required',
            'employeeInfo.gender' => 'required',
            'employeeInfo.address' => 'required',
            'employeeInfo.max_leave_allowed' => 'required',
            'employeeInfo.is_active' => 'required',
        ]);

        $this->employee->update([
            'id' => $this->employeeInfo['id'],
            'contract_id' => $this->employeeInfo['contract_id'],
            'first_name' => $this->employeeInfo['first_name'],
            'father_name' => $this->employeeInfo['father_name'],
            'last_name' => $this->employeeInfo['last_name'],
            'mother_name' => $this->employeeInfo['mother_name'],
            'birth_and_place' => $this->employeeInfo['birth_and_place'],
            'national_number' => $this->employeeInfo['national_number'],
            'mobile_number' => $this->employeeInfo['mobile_number'],
            'degree' => $this->employeeInfo['degree'],
            'gender' => $this->employeeInfo['gender'],
            'address' => $this->employeeInfo['address'],
            // 'notes' => $this->employeeInfo['notes'],
            'max_leave_allowed' => $this->employeeInfo['max_leave_allowed'],
            // 'delay_counter' => $this->delay_counter,
            // 'hourly_counter' => $this->hourly_counter,
            'is_active' => $this->employeeInfo['is_active'],
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
