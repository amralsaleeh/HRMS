<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Center;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Timeline;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EmployeeInfo extends Component
{
    public $centers;

    public $departments;

    public $positions;

    public $employee;

    public $employeeTimelines;

    public $employeeInfo = [];

    public $isEdit;

    // 👉 Mount
    public function mount($id)
    {
        $this->employee = Employee::find($id);

        $this->centers = Center::all();
        $this->departments = department::all();
        $this->positions = Position::all();
    }

    // 👉 Render
    public function render()
    {
        $this->employeeTimelines = Timeline::with(['center', 'department', 'position'])
            ->where('employee_id', $this->employee->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.human-resource.structure.employee-info');
    }

    // 👉 Toggle active status
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

    // 👉 Submit timeline
    public function submitTimeline()
    {
        $this->validate([
            'employeeInfo.position' => 'required',
            'employeeInfo.department' => 'required',
            'employeeInfo.center' => 'required',
            'employeeInfo.start_date' => 'required',
            'employeeInfo.is_sequent' => 'required',
        ]);

        $this->isEdit ? $this->updateTimeline() : $this->storeTimeline();
    }

    // 👉 Store timeline
    public function storeTimeline()
    {
        DB::beginTransaction();
        try {
            $presentTimeline = $this->employee
                ->timelines()
                ->orderBy('timelines.id', 'desc')
                ->first();

            $presentTimeline->end_date = Carbon::now();
            $presentTimeline->save();

            Timeline::create([
                'employee_id' => $this->employee->id,
                'position_id' => $this->employeeInfo['position'],
                'department_id' => $this->employeeInfo['department'],
                'center_id' => $this->employeeInfo['center'],
                'start_date' => $this->employeeInfo['start_date'],
                'end_date' => isset($this->employeeInfo['end_date']) ? $this->employeeInfo['end_date'] : null,
                'is_sequent' => $this->employeeInfo['is_sequent'],
                'notes' => isset($this->employeeInfo['notes']) ? $this->employeeInfo['notes'] : null,
            ]);

            $this->dispatch('closeModal', elementId: '#timelineModal');
            $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $this->dispatch(
                'toastr',
                type: 'success' /* , title: 'Done!' */,
                message: 'Something is going wrong, check the log file!'
            );
            throw $e;
        }
    }

    // 👉 Update timeline
    public function updateTimeline()
    {
        //
    }
}
