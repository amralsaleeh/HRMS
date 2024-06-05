<?php

namespace App\Livewire;

use App\Jobs\sendPendingMessages;
use App\Models\Center;
use App\Models\Changelog;
use App\Models\Employee;
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

    public $isEdit = false;

    public $leaveRecords = [];

    public $newLeaveInfo = [];

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

        $this->fromDateLimit = Carbon::now()->subDays(7)->format('Y-m-d');
        $this->changelogs = Changelog::latest()->get();
    }

    public function render()
    {
        $this->leaveRecords = DB::table('employee_leave')
            ->where('created_by', Auth::user()->name)
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
        $this->reset('selectedEmployeeId', 'employeePhoto', 'newLeaveInfo');
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

        $this->isEdit ? $this->editLeave() : $this->addLeave();
    }

    public function addLeave()
    {
        $employee = Employee::find($this->selectedEmployeeId);

        if (substr($this->newLeaveInfo['LeaveId'], 1, 1) == 1 && ($this->newLeaveInfo['startAt'] != null || $this->newLeaveInfo['endAt'] != null)) {
            session()->flash('error', 'Cann\'t add daily leave with time!');
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

        $employee->leaves()->attach($this->newLeaveInfo['LeaveId'], [
            'from_date' => $this->newLeaveInfo['fromDate'],
            'to_date' => $this->newLeaveInfo['toDate'],
            'start_at' => $this->newLeaveInfo['startAt'],
            'end_at' => $this->newLeaveInfo['endAt'],
            'note' => $this->newLeaveInfo['note'],
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
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
