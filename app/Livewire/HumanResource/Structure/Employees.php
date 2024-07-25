<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Contract;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;

    // 👉 Variables
    public $searchTerm = null;

    public $contracts;

    public $employee;

    public $employeeInfo = [];

    public $isEdit = false;

    public $confirmedId;

    // 👉 Mount
    public function mount()
    {
        $this->contracts = Contract::all();
    }

    // 👉 Render
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

    // 👉 Submit employee
    public function submitEmployee()
    {
        $this->validate([
            'employeeInfo.id' => 'required',
            'employeeInfo.contractId' => 'required',
            'employeeInfo.firstName' => 'required',
            'employeeInfo.fatherName' => 'required',
            'employeeInfo.lastName' => 'required',
            'employeeInfo.motherName' => 'required',
            'employeeInfo.birthAndPlace' => 'required',
            'employeeInfo.nationalNumber' => 'required|min:11|max:11',
            'employeeInfo.mobileNumber' => 'required|min:9|max:9|regex:/^[1-9][0-9]*$/',
            'employeeInfo.degree' => 'required',
            'employeeInfo.gender' => 'required',
            'employeeInfo.address' => 'required',
        ]);

        $this->isEdit ? $this->editEmployee() : $this->addEmployee();
    }

    // 👉 Store employee
    public function showCreateEmployeeModal()
    {
        $this->reset('isEdit', 'employeeInfo');
    }

    public function addEmployee()
    {
        $createdEmployee = Employee::create([
            'id' => $this->employeeInfo['id'],
            'contract_id' => $this->employeeInfo['contractId'],
            'first_name' => $this->employeeInfo['firstName'],
            'father_name' => $this->employeeInfo['fatherName'],
            'last_name' => $this->employeeInfo['lastName'],
            'mother_name' => $this->employeeInfo['motherName'],
            'birth_and_place' => $this->employeeInfo['birthAndPlace'],
            'national_number' => $this->employeeInfo['nationalNumber'],
            'mobile_number' => $this->employeeInfo['mobileNumber'],
            'degree' => $this->employeeInfo['degree'],
            'gender' => $this->employeeInfo['gender'],
            'address' => $this->employeeInfo['address'],
            'notes' => isset($this->employeeInfo['notes']) ? $this->employeeInfo['notes'] : null,
        ]);

        $this->dispatch('closeModal', elementId: '#employeeModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        session()->flash('openTimelineModal', true);

        return redirect()->route('structure-employees-info', ['id' => $createdEmployee->id]);
    }

    // 👉 Update employee
    public function showEditEmployeeModal(Employee $employee)
    {
        $this->isEdit = true;

        $this->employee = $employee;

        $this->employeeInfo['id'] = $employee->id;
        $this->employeeInfo['contractId'] = $employee->contract_id;
        $this->employeeInfo['firstName'] = $employee->first_name;
        $this->employeeInfo['fatherName'] = $employee->father_name;
        $this->employeeInfo['lastName'] = $employee->last_name;
        $this->employeeInfo['motherName'] = $employee->mother_name;
        $this->employeeInfo['birthAndPlace'] = $employee->birth_and_place;
        $this->employeeInfo['nationalNumber'] = $employee->national_number;
        $this->employeeInfo['mobileNumber'] = $employee->mobile_number;
        $this->employeeInfo['degree'] = $employee->degree;
        $this->employeeInfo['gender'] = $employee->gender;
        $this->employeeInfo['address'] = $employee->address;
        $this->employeeInfo['notes'] = $employee->notes;
    }

    public function editEmployee()
    {
        $this->employee->update([
            'id' => $this->employeeInfo['id'],
            'contract_id' => $this->employeeInfo['contractId'],
            'first_name' => $this->employeeInfo['firstName'],
            'father_name' => $this->employeeInfo['fatherName'],
            'last_name' => $this->employeeInfo['lastName'],
            'mother_name' => $this->employeeInfo['motherName'],
            'birth_and_place' => $this->employeeInfo['birthAndPlace'],
            'national_number' => $this->employeeInfo['nationalNumber'],
            'mobile_number' => $this->employeeInfo['mobileNumber'],
            'degree' => $this->employeeInfo['degree'],
            'gender' => $this->employeeInfo['gender'],
            'address' => $this->employeeInfo['address'],
            'notes' => isset($this->employeeInfo['notes']) ? $this->employeeInfo['notes'] : null,
        ]);

        $this->dispatch('closeModal', elementId: '#employeeModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    // 👉 Delete employee
    public function confirmDeleteEmployee($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteEmployee(Employee $employee)
    {
        $employee->delete();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }
}
