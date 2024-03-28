<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Livewire\Component;

class EmployeeInfo extends Component
{
    public $employee;

    // public $employee_id;
    public $timelines;

    public $position;

    public $employeePosition;

    public $positions;

    public $Centers;

    public $employeeCenter;

    public $departments;

    public $employeeDepartment;

    public $center;

    public $startDate;

    public $quitDate;

    public function mount($id)
    {
        $this->employee = Employee::find($id);
        $this->timelines = Timeline::with(['center', 'department', 'position'])->where('employee_id', $id)->get();
        // dd($this->timeline);
        $this->position = Timeline::with('position')->where('employee_id', $id)->first();
        $this->positions = Position::all();
        $this->Centers = Center::all();
        $this->departments = department::all();
        $this->dispatch('closeModal', elementId: '#employeeinfoModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        // dd($this->posation->start_date);
    }

    public function render()
    {
        return view('livewire.human-resource.structure.employee-info');
    }

    public function submitTimeline()
    {
        // $this->validate();

        Timeline::create([
            'employee_id' => $this->employee->id,
            'center_id' => $this->employeeCenter,
            'department_id' => $this->employeeDepartment,
            'position_id' => $this->employeePosition,
            'start_date' => $this->startDate,
            'end_date' => $this->quitDate,

        ]);

        $this->dispatch('closeModal', elementId: '#centerModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }
}
