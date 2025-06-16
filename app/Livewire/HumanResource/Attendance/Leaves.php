<?php

namespace App\Livewire\HumanResource\Attendance;

use App\Exports\ExportLeaves;
use App\Imports\ImportLeaves;
use App\Livewire\Sections\Navbar\Navbar;
use App\Models\Center;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\Leave;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Leaves extends Component
{
    use WithFileUploads, WithPagination;

    /*
                Leave ID Structure:
                1 Leave - 1 Daily  - LeaveID
                2 Task  - 2 Hourly - LeaveID
                */

    // 👉 Variables
    public $activeEmployees = [];

    public $selectedEmployee;

    public $selectedEmployeeId;

    public $dateRange;

    public $fromDate;

    public $toDate;

    public $employeeLeaveId;

    public $newLeaveInfo = [
        'LeaveId' => '',
        'fromDate' => null,
        'toDate' => null,
        'startAt' => null,
        'endAt' => null,
        'note' => null,
    ];

    public $isEdit = false;

    public $leaveTypes;

    public $selectedLeave;

    public $selectedLeaveId;

    public $confirmedId;

    public $file;

    public function mount()
    {
        $this->selectedEmployeeId = Auth::user()->employee_id;
        $this->selectedEmployee = Employee::find(Auth::user()->employee_id);

        $this->leaveTypes = Leave::all();

        $user = Employee::find(Auth::user()->employee_id);
        $center = Center::find(
            $user
                ->timelines()
                ->where('end_date', null)
                ->first()->center_id
        );
        $this->activeEmployees = $center->activeEmployees();

        $currentDate = Carbon::now();
        $previousMonth = $currentDate->copy()->subMonth();
        $this->dateRange = $previousMonth->format('Y-n-1').' to '.$currentDate;
    }

    public function render()
    {
        $leaves = $this->applyFilter();

        return view('livewire.human-resource.attendance.leaves', [
            'leaves' => $leaves,
        ]);
    }

    public function applyFilter()
    {
        $this->selectedEmployee = Employee::find($this->selectedEmployeeId);

        $this->selectedLeave = Leave::find($this->selectedLeaveId);

        if ($this->dateRange) {
            $dates = explode(' to ', $this->dateRange);

            $this->fromDate = $dates[0];
            $this->toDate = $dates[1];
        }

        if (
            auth()
                ->user()
                ->hasAnyRole(['Admin', 'HR'])
        ) {
            // Return filtered leaves
            return Employee::find($this->selectedEmployeeId)
                ->leaves()
                ->when($this->selectedLeaveId, function ($query) {
                    return $query->where('leaves.id', $this->selectedLeaveId);
                })
                ->whereBetween('from_date', [$this->fromDate, $this->toDate])
                ->orderBy('from_date')
                ->paginate(7);
        }

        // Return filtered leaves
        return Employee::find($this->selectedEmployeeId)
            ->leaves()
            ->when($this->selectedLeaveId, function ($query) {
                return $query->where('leaves.id', $this->selectedLeaveId);
            })
            ->whereBetween('from_date', [$this->fromDate, $this->toDate])
            ->where('is_checked', 0)
            ->orderBy('from_date')
            ->paginate(7);
    }

    public function submitLeave()
    {
        $this->validate(
            [
                'selectedEmployeeId' => 'required',
                'newLeaveInfo.LeaveId' => 'required',
                'newLeaveInfo.fromDate' => 'required|date',
                'newLeaveInfo.toDate' => 'required|date',
            ],
            null,
            [
                'selectedEmployeeId' => 'Employee',
                'newLeaveInfo.LeaveId' => 'Type',
                'newLeaveInfo.fromDate' => 'From Date',
                'newLeaveInfo.toDate' => 'To Date',
            ]
        );

        if (
            substr($this->newLeaveInfo['LeaveId'], 1, 1) == 1 &&
            ($this->newLeaveInfo['startAt'] != null || $this->newLeaveInfo['endAt'] != null)
        ) {
            session()->flash('error', __('Can\'t add daily leave with time!'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if (
            substr($this->newLeaveInfo['LeaveId'], 1, 1) == 2 &&
            ($this->newLeaveInfo['startAt'] == null || $this->newLeaveInfo['endAt'] == null)
        ) {
            session()->flash('error', __('Can\'t add hourly leave without time!'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if (
            substr($this->newLeaveInfo['LeaveId'], 1, 1) == 2 &&
            $this->newLeaveInfo['fromDate'] != $this->newLeaveInfo['toDate'] &&
            $this->newLeaveInfo['LeaveId'] != '1210'
        ) {
            session()->flash('error', __('Hourly leave must be on the same day!'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
            session()->flash('error', __('Check the dates entered. "From Date" cannot be greater than "To Date"'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if ($this->newLeaveInfo['startAt'] > $this->newLeaveInfo['endAt']) {
            session()->flash('error', __('Check the times entered. "Start At" cannot be greater than "End To"'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        $this->isEdit ? $this->updateLeave() : $this->createLeave();
    }

    public function showCreateLeaveModal()
    {
        $this->dispatch('clearSelect2Values');
        $this->reset('isEdit', 'newLeaveInfo');
    }

    public function createLeave()
    {
        EmployeeLeave::firstOrCreate([
            'employee_id' => $this->selectedEmployeeId,
            'leave_id' => $this->newLeaveInfo['LeaveId'],
            'from_date' => $this->newLeaveInfo['fromDate'],
            'to_date' => $this->newLeaveInfo['toDate'],
            'start_at' => $this->newLeaveInfo['startAt'],
            'end_at' => $this->newLeaveInfo['endAt'],
            'note' => $this->newLeaveInfo['note'],
        ]);

        session()->flash('success', __('Success, record created successfully!'));
        $this->dispatch('scrollToTop');

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function showUpdateLeaveModal($id)
    {
        $this->reset('newLeaveInfo');

        $this->isEdit = true;
        $this->employeeLeaveId = $id;

        $record = DB::table('employee_leave')
            ->where('id', $this->employeeLeaveId)
            ->first();

        $this->selectedEmployeeId = $record->employee_id;
        $this->newLeaveInfo = [
            'LeaveId' => $record->leave_id,
            'fromDate' => $record->from_date,
            'toDate' => $record->to_date,
            'startAt' => $record->start_at,
            'endAt' => $record->end_at,
            'note' => $record->note,
        ];

        $this->dispatch('setSelect2Values', employeeId: $this->selectedEmployeeId, leaveId: $record->leave_id);
    }

    public function updateLeave()
    {
        EmployeeLeave::find($this->employeeLeaveId)->update([
            'employee_id' => $this->selectedEmployeeId,
            'leave_id' => $this->newLeaveInfo['LeaveId'],
            'from_date' => $this->newLeaveInfo['fromDate'],
            'to_date' => $this->newLeaveInfo['toDate'],
            'start_at' => $this->newLeaveInfo['startAt'],
            'end_at' => $this->newLeaveInfo['endAt'],
            'note' => $this->newLeaveInfo['note'],
        ]);

        session()->flash('success', __('Success, record updated successfully!'));
        $this->dispatch('scrollToTop');

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));

        $this->reset('isEdit', 'newLeaveInfo');
    }

    public function confirmDestroyLeave($id)
    {
        $this->confirmedId = $id;
    }

    public function destroyLeave()
    {
        $this->selectedEmployee
            ->leaves()
            ->wherePivot('id', $this->confirmedId)
            ->detach();
        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
    }

    public function importFromExcel()
    {
        $this->validate(
            [
                'file' => 'required|mimes:xlsx',
            ],
            [
                'file.required' => 'Please select a file to upload',
                'file.mimes' => 'Excel files is accepted only',
            ]
        );

        try {
            Excel::import(new ImportLeaves(), $this->file);

            Notification::send(
                Auth::user(),
                new DefaultNotification(Auth::user()->id, 'Successfully imported the leaves file')
            );
            $this->dispatch('refreshNotifications')->to(Navbar::class);

            session()->flash('success', __('Well done! The file has been imported successfully.'));
        } catch (Exception $e) {
            session()->flash('error', __('Error occurred: ').$e->getMessage());
        }

        $this->dispatch('closeModal', elementId: '#importModal');
    }

    public function exportToExcel()
    {
        $user = Employee::find(Auth::user()->employee_id);
        $center = Center::find(
            $user
                ->timelines()
                ->where('end_date', null)
                ->first()->center_id
        );
        $this->activeEmployees = $center->activeEmployees();

        $centerEmployees = array_map(function ($object) {
            return $object['id'];
        }, $this->activeEmployees->toArray());

        $firstName = explode(' ', Auth::user()->name)[0];

        $leavesToExport = DB::table('employee_leave')
            ->select([
                'employee_leave.id AS ID',
                DB::raw('CONCAT(employees.first_name, " ", employees.last_name) AS Employee'),
                'leaves.name AS Leave',
                'employee_leave.from_date AS From Date',
                'employee_leave.to_date AS To Date',
                'employee_leave.start_at AS Start At',
                'employee_leave.end_at AS End At',
                'employee_leave.note AS Note',
                'employee_leave.created_by As Created By',
                'employee_leave.updated_by As Updated By',
            ])
            ->leftJoin('employees', 'employee_leave.employee_id', '=', 'employees.id') // Left join for missing employee
            ->leftJoin('leaves', 'employee_leave.leave_id', '=', 'leaves.id') // Left join for missing leave type
            ->whereIn('employee_leave.employee_id', $centerEmployees)
            ->where(
                'employee_leave.created_at',
                '>=',
                Carbon::now()
                    ->subDays(7)
                    ->format('Y-m-d')
            )
            ->where('is_checked', 0)
            ->where(DB::raw('SUBSTRING_INDEX(employee_leave.created_by, " ", 1)'), '=', $firstName)
            ->get();

        session()->flash('success', __('Well done! The file has been exported successfully.'));

        return Excel::download(
            new ExportLeaves($leavesToExport),
            'Leaves - '.
              Auth::user()->name.
              ' - '.
              Carbon::now()
                  ->subDays(7)
                  ->format('Y-m-d').
              ' --- '.
              Carbon::now()->format('Y-m-d').
              '.xlsx'
        );
    }
}
