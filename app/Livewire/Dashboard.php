<?php

namespace App\Livewire;

use App\Jobs\sendPendingMessages;
use App\Models\Center;
use App\Models\Changelog;
use App\Models\Discount;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\Leave;
use App\Models\Message;
use App\Models\Timeline;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Livewire\Component;
use Throwable;

class Dashboard extends Component
{
    public $employee;

    public $accountBalance = ['status' => 400, 'balance' => '---', 'is_active' => '---'];

    public $messagesStatus = ['sent' => 0, 'unsent' => 0];

    public $changelogs;

    public $activeEmployees;

    public $center;

    public $selectedEmployeeId;

    public $leaveTypes;

    public $employeeLeaveId;

    public $employeeLeaveRecord;

    public $isEdit = false;

    public $confirmedId;

    public $leaveRecords = [];

    public $newLeaveInfo = [
        'LeaveId' => '',
        'fromDate' => null,
        'toDate' => null,
        'startAt' => null,
        'endAt' => null,
        'note' => null,
    ];

    public $fromDateLimit;

    public $employeePhoto = 'profile-photos/.default-photo.jpg';

    public $latestBatch;

    public $employeeDiscounts;

    public $batchDates;

    public $showStatictics = 1;

    public function mount()
    {
        $user = Employee::find(Auth::user()->employee_id);

        $this->employee = $user;

        $center = null;
        if ($user) {
            $activeTimeline = $user->timelines()->whereNull('end_date')->first();
            if ($activeTimeline) {
                $center = Center::find($activeTimeline->center_id);
            }
        }

        // If the current user is an Employee, limit activeEmployees to only their timeline
        if (Auth::user()->hasAnyRole(['Employee', 'Viewer'])) {
            // Return only the current employee's active timeline(s)
            $this->activeEmployees = $user
                ? Timeline::where('employee_id', $user->id)
                ->whereNull('end_date')
                ->with('employee')
                ->get()
                : collect();
        } else {
            $this->activeEmployees = $center ? $center->activeEmployees() : collect();
        }

        $this->selectedEmployeeId = Auth::user()->employee_id;
        $this->employeePhoto = $user?->profile_photo_path ?? 'profile-photos/.default-photo.jpg';

        $this->leaveTypes = Leave::all();

        try {
            $this->accountBalance = $this->CheckAccountBalance();
        } catch (Throwable $th) {
            //
        }

        $this->employeeDiscounts = $this->getEmployeeDiscounts();

        $this->fromDateLimit = Carbon::now()
            ->subDays(30)
            ->format('Y-m-d');
        $this->changelogs = Changelog::latest()->get();

        $this->applyContractRestrictions();
    }

    private function applyContractRestrictions(): void
    {
        try {
            $employee = $this->employee;
            if (! $employee) {
                return;
            }

            $contract = $employee->contract;
            if (! $contract || (int) $contract->work_rate !== 100) {
                $this->showStatictics = 0;
            }
        } catch (\Throwable $e) {
            //
        }
    }

    public function render()
    {
        $sent = Message::where('is_sent', 1)->count();
        $unsent = Message::where('is_sent', 0)->count();

        $this->messagesStatus = [
            'sent' => Number::format($sent ?? 0),
            'unsent' => Number::format($unsent ?? 0),
        ];

        if (Auth::user()->hasAnyRole(['Employee', 'Viewer'])) {
            $this->leaveRecords = EmployeeLeave::where('employee_id', Auth::user()->employee_id)
                ->whereBetween('created_at', [
                    Carbon::now()
                        ->subDays(7)
                        ->startOfDay(),
                    Carbon::now()->endOfDay(),
                ])
                ->orderBy('created_at')
                ->get();
        } else {
            $this->leaveRecords = EmployeeLeave::where('created_by', Auth::user()->name)
                ->whereDate('created_at', Carbon::today()->toDate())
                ->orderBy('created_at')
                ->get();
        }

        return view('livewire.dashboard');
    }

    public function updatedSelectedEmployeeId()
    {
        $employee = Employee::find($this->selectedEmployeeId);

        if ($employee) {
            $this->employeePhoto = $employee->profile_photo_path;
        } else {
            $this->reset('employeePhoto');
        }
    }

    public function sendPendingMessages()
    {
        $this->authorizeAccess();

        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessages::dispatch();
            session()->flash('info', __('Let\'s go! Personal on their way!'));
        } else {
            $this->dispatch('toastr', type: 'info' /* , title: 'Done!' */, message: __('Everything has sent already!'));
        }
    }

    public function showCreateLeaveModal()
    {
        $this->authorizeAccess();

        $this->dispatch('clearSelect2Values');
        $this->reset('newLeaveInfo', 'isEdit');
    }

    public function createLeave()
    {
        $this->authorizeAccess();

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

    public function showEditLeaveModal($id)
    {
        $this->authorizeAccess();

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
        $this->authorizeAccess();

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

    public function submitLeave()
    {
        $this->authorizeAccess();

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
            session()->flash('error', __('Hourly leave must be on the same day'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
            session()->flash('error', __('Check the dates entered. "From Date" can not be greater than "To Date"'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        if ($this->newLeaveInfo['startAt'] > $this->newLeaveInfo['endAt']) {
            session()->flash('error', __('Check the times entered. "Start At" can not be greater than "End To"'));
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error' /* , title: 'Done!' */, message: __('Requires Attention!'));

            return;
        }

        $this->isEdit ? $this->updateLeave() : $this->createLeave();
    }

    public function confirmDestroyLeave($id)
    {
        $this->authorizeAccess();

        $this->confirmedId = $id;
    }

    public function destroyLeave()
    {
        $this->authorizeAccess();

        EmployeeLeave::find($this->confirmedId)->delete();

        $this->dispatch('toastr', type: 'success' /* , title: 'Done!' */, message: __('Going Well!'));
        $this->confirmedId = null;
    }

    public function getEmployeeName($id)
    {
        return Employee::find($id)->FullName;
    }

    public function getLeaveType($id)
    {
        return Leave::find($id)->name;
    }

    public function getEmployeeDiscounts()
    {
        $employeeId = auth()->user()->employee_id;

        $this->latestBatch = Discount::select('batch')
            ->orderByRaw("STR_TO_DATE(SUBSTRING_INDEX(batch, ' to ', 1), '%Y-%m-%d') DESC")
            ->limit(1)
            ->value('batch');

        $discounts = Discount::where('employee_id', $employeeId)
            ->where('batch', $this->latestBatch)
            ->get();

        $this->batchDates = explode(' to ', $this->latestBatch);

        return $discounts;
    }

    private function authorizeAccess()
    {
        if (
            ! auth()
                ->user()
                ->hasAnyRole(['Admin', 'HR', 'CC', 'CR', 'CR-S'])
        ) {
            abort(403, 'Unauthorized action.');
        }
    }
}
