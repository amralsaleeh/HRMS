<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Carbon\Carbon;
use Livewire\Component;

class EmployeeInfo extends Component
{
    public $centers;

    public $departments;

    public $positions;

    public $employee;

    public $employeeTimelines;

    public $employeeInfo = [];

    public function mount($id)
    {
        $this->employee = Employee::find($id);

        $this->centers = Center::all();
        $this->departments = department::all();
        $this->positions = Position::all();
    }

    public function render()
    {
        $this->employeeTimelines = Timeline::with(['center', 'department', 'position'])
            ->where('employee_id', $this->employee->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.human-resource.structure.employee-info');
    }

    public function toggleActive()
    {
        $presentTimeline = $this->employee
            ->timelines()
            ->orderBy('timelines.id', 'desc')
            ->first();

        if ($this->employee->is_active == true) {
            $this->employee->is_active = false;
            $presentTimeline->end_date = Carbon::now();
        } else {
            $this->employee->is_active = true;
            $presentTimeline->end_date = null;
        }

        $this->employee->save();
        $presentTimeline->save();

        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }

    public function storeTimeline()
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
            'position_id' => $this->employeeInfo['position'],
            'department_id' => $this->employeeInfo['department'],
            'center_id' => $this->employeeInfo['center'],
            'start_date' => $this->employeeInfo['start_date'],
            'end_date' => $this->employeeInfo['end_date'],
            'notes' => $this->employeeInfo['notes'],
            'is_sequent' => $this->employeeInfo['is_sequent'],
        ]);

        $this->dispatch('closeModal', elementId: '#add-timeline');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }

    public function updateTimeline()
    {
    }
}
