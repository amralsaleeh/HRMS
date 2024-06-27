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

    public $employeeInfo = [];

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
        $this->validate([
            'employeeInfo.position' => 'required',
            'employeeInfo.department' => 'required',
            'employeeInfo.center' => 'required',
            'employeeInfo.start_date' => 'required',
            'employeeInfo.end_date' => 'required',
            'employeeInfo.is_sequent' => 'required',
        ]);

        Timeline::create([
            'employee_id' => $this->employee->id,
            'position_id' =>$this->employeeInfo['position'],
            'department_id'=>$this->employeeInfo['department'],
            'center_id' => $this->employeeInfo['center'],
            'start_date' => $this->employeeInfo['start_date'],
            'end_date' => $this->employeeInfo['end_date'],
            'notes' => $this->employeeInfo['notes'],
            'is_sequent' => $this->employeeInfo['is_sequent'],
        ]);

        $this->dispatch('closeModal', elementId: '#add-timeline');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }
}
