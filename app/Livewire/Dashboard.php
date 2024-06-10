<?php

namespace App\Livewire;

use App\Jobs\sendPendingMessages;
use App\Models\Center;
use App\Models\Changelog;
use App\Models\Employee;
use App\Models\EmployeeLeave;
use App\Models\Leave;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Livewire\Component;
use Throwable;

class Dashboard extends Component
{
    public $accountBalance = ['status' => 400, 'balance' => 'N/A', 'is_active' => 'N/A'];

    public $messagesStatus = ['sent' => 0, 'unsent' => 0];

    public $changelogs;

    public $activeEmployees;

    public $center;

    public $selectedEmployeeId = null;

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

    public function mount()
    {
        $user = Employee::find(Auth::user()->employee_id);
        $center = Center::find($user->timelines()->where('end_date', null)->first()->center_id);
        $this->activeEmployees = $center->activeEmployees()->get();

        $this->leaveTypes = Leave::all();

        try {
            $this->accountBalance = $this->CheckAccountBalance();
            $this->messagesStatus = Message::selectRaw('SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent, SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent')
                ->first();
            $this->messagesStatus = ['sent' => Number::format($this->messagesStatus['sent'] != null ? $this->messagesStatus['sent'] : 0), 'unsent' => Number::format($this->messagesStatus['unsent'] != null ? $this->messagesStatus['unsent'] : 0)];
        } catch (Throwable $th) {
            //
        }

        $this->fromDateLimit = Carbon::now()->subDays(30)->format('Y-m-d');
        $this->changelogs = Changelog::latest()->get();
    }

    public function render()
    {
        $this->leaveRecords = EmployeeLeave::where('created_by', Auth::user()->name)
            ->whereDate('created_at', Carbon::today()->toDate())
            ->orderBy('created_at')
            ->get();

        return view('livewire.dashboard');
    }

    public function updatedSelectedEmployeeId()
    {
        $this->employeePhoto = Employee::find($this->selectedEmployeeId)?->profile_photo_path;
    }

    public function sendPendingMessages()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessages::dispatch();
            session()->flash('info', "Let's go! Messages on their way!");
        } else {
            $this->dispatch('toastr', type: 'info'/* , title: 'Done!' */ , message: 'Everything has sent already!');
        }
    }

    public function showCreateLeaveModal()
    {
        $this->dispatch('clearSelect2Values');
        $this->reset('selectedEmployeeId', 'employeePhoto', 'newLeaveInfo', 'isEdit');
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

        session()->flash('success', 'Success, record created successfully!');
        $this->dispatch('scrollToTop');

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function showEditLeaveModal($id)
    {
        $this->reset('newLeaveInfo');

        $this->isEdit = true;
        $this->employeeLeaveId = $id;

        $record = DB::table('employee_leave')->where('id', $this->employeeLeaveId)->first();

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

        session()->flash('success', 'Success, record updated successfully!');
        $this->dispatch('scrollToTop');

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset('isEdit', 'newLeaveInfo');
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
            ]);

        if (substr($this->newLeaveInfo['LeaveId'], 1, 1) == 1 && ($this->newLeaveInfo['startAt'] != null || $this->newLeaveInfo['endAt'] != null)) {
            session()->flash('error', 'Cann\'t add daily leave with time!');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        if (substr($this->newLeaveInfo['LeaveId'], 1, 1) == 2 && ($this->newLeaveInfo['startAt'] == null || $this->newLeaveInfo['endAt'] == null)) {
            session()->flash('error', 'Cann\'t add hourly leave without time!');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
            session()->flash('error', 'Check the dates entered. "From Date" cannot be greater than "To Date"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        if ($this->newLeaveInfo['startAt'] > $this->newLeaveInfo['endAt']) {
            session()->flash('error', 'Check the times entered. "Start At" cannot be greater than "End To"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        $this->isEdit ? $this->updateLeave() : $this->createLeave();
    }

    public function confirmDestroyLeave($id)
    {
        $this->confirmedId = $id;
    }

    public function destroyLeave()
    {
        EmployeeLeave::find($this->confirmedId)->delete();

        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
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
}
