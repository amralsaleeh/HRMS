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

    public $timeline;

    public $employeeTimelines;

    public $employeeTimelineInfo = [];

    public $isEdit = false;

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
            'employeeTimelineInfo.centerId' => 'required',
            'employeeTimelineInfo.departmentId' => 'required',
            'employeeTimelineInfo.positionId' => 'required',
            'employeeTimelineInfo.startDate' => 'required',
            'employeeTimelineInfo.isSequent' => 'required',
        ]);

        $this->isEdit ? $this->updateTimeline() : $this->storeTimeline();
    }

    // 👉 Store timeline
    public function showStoreTimelineModal()
    {
        $this->reset('isEdit', 'employeeTimelineInfo');
    }

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
                'position_id' => $this->employeeTimelineInfo['positionId'],
                'department_id' => $this->employeeTimelineInfo['departmentId'],
                'center_id' => $this->employeeTimelineInfo['centerId'],
                'start_date' => $this->employeeTimelineInfo['startDate'],
                'end_date' => isset($this->employeeTimelineInfo['endDate']) ? $this->employeeTimelineInfo['endDate'] : null,
                'is_sequent' => $this->employeeTimelineInfo['isSequent'],
                'notes' => isset($this->employeeTimelineInfo['notes']) ? $this->employeeTimelineInfo['notes'] : null,
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
    public function showUpdateTimelineModal(Timeline $timeline)
    {
        $this->isEdit = true;

        $this->timeline = $timeline;

        $this->employeeTimelineInfo['centerId'] = $timeline->center_id;
        $this->employeeTimelineInfo['departmentId'] = $timeline->department_id;
        $this->employeeTimelineInfo['positionId'] = $timeline->position_id;
        $this->employeeTimelineInfo['startDate'] = $timeline->start_date;
        $this->employeeTimelineInfo['endDate'] = $timeline->end_date;
        $this->employeeTimelineInfo['isSequent'] = $timeline->is_sequent;
        $this->employeeTimelineInfo['notes'] = $timeline->notes;
    }

    public function updateTimeline()
    {
        $this->timeline->update([
            'center_id' => $this->employeeTimelineInfo['centerId'],
            'department_id' => $this->employeeTimelineInfo['departmentId'],
            'position_id' => $this->employeeTimelineInfo['positionId'],
            'start_date' => $this->employeeTimelineInfo['startDate'],
            'end_date' => $this->employeeTimelineInfo['endDate'],
            'is_sequent' => $this->employeeTimelineInfo['isSequent'],
            'notes' => $this->employeeTimelineInfo['notes'],
        ]);

        $this->dispatch('closeModal', elementId: '#timelineModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: 'Going Well!');
    }
}
