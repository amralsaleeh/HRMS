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

    public $fromDate;

    public $toDate;

    public $startAt;

    public $endAt;

    public $leaveRecords = [];

    public $newLeaveInfo = [];

    public $confirmedId;

    public $employee_leave_id;

    public $employeeName;

    public $leaveTypeName;

    // public $selectedEmployee;

    public function mount()
    {
        $user = Employee::find(Auth::user()->employee_id);
        $center = Center::find($user->timelines()->where('end_date', null)->first()->center_id);

        $this->leaveTypes = Leave::all();
        $this->activeEmployees = $center->activeEmployees()->get();
        // $this->selectedEmployee = Employee::find(1);

        try {
            $this->accountBalance = $this->CheckAccountBalance();
            $this->messagesStatus = Message::selectRaw('SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent, SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent')
                ->first();
            $this->messagesStatus = ['sent' => Number::format($this->messagesStatus['sent'] != null ? $this->messagesStatus['sent'] : 0), 'unsent' => Number::format($this->messagesStatus['unsent'] != null ? $this->messagesStatus['unsent'] : 0)];
        } catch (Throwable $th) {
            //
        }

        $this->changelogs = Changelog::all();
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

    public function sendPendingMessages()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessages::dispatch();
            session()->flash('info', "Let's go! Messages on their way!");
        } else {
            $this->dispatch('toastr', type: 'info'/* , title: 'Done!' */ , message: 'Everything has sent already!');
        }
    }

    public function submitLeave()
    {
        $this->isEdit ? $this->editLeave() : $this->addLeave();
    }

    public function addLeave()
    {
        $employee = Employee::find($this->selectedEmployeeId);

        if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
            session()->flash('error', 'Check the dates entered. "From Date" cannot be greater than "To Date"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        if ($this->startAt > $this->endAt) {
            session()->flash('error', 'Check the times entered. "Start At" cannot be greater than "End To"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        $employee->leaves()->attach($this->newLeaveInfo['LeaveId'], [
            'from_date' => $this->newLeaveInfo['fromDate'],
            'to_date' => $this->newLeaveInfo['toDate'],
            'start_at' => $this->startAt,
            'end_at' => $this->endAt,
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

    public function editLeave()
    {
        // Find the existing leave record
        $leave = DB::table('employee_leave')->where('id', $this->employee_leave_id)->first();

        // if (! $leave) {
        //     $this->handleLeaveError('Leave record not found.');

        //     return;
        // }

        // Validate the input dates and times
        // if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
        //     $this->handleLeaveError('Check the dates entered. "From Date" cannot be greater than "To Date"');

        //     return;
        // }

        // if ($this->startAt > $this->endAt) {
        //     $this->handleLeaveError('Check the times entered. "Start At" cannot be greater than "End To"');

        //     return;
        // }

        // Update the leave record
        if ($this->newLeaveInfo['fromDate'] > $this->newLeaveInfo['toDate']) {
            session()->flash('error', 'Check the dates entered. "From Date" cannot be greater than "To Date"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        if ($this->startAt > $this->endAt) {
            session()->flash('error', 'Check the times entered. "Start At" cannot be greater than "End To"');
            $this->dispatch('closeModal', elementId: '#leaveModal');
            $this->dispatch('toastr', type: 'error'/* , title: 'Done!' */ , message: 'Requires Attention!');

            return;
        }

        DB::table('employee_leave')->where('id', $this->employee_leave_id)->update([
            'from_date' => $this->newLeaveInfo['fromDate'],
            'to_date' => $this->newLeaveInfo['toDate'],
            'start_at' => $this->startAt,
            'end_at' => $this->endAt,
            // 'updated_by' => Auth::user()->name,
            // 'updated_at' => now(),
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->dispatch('closeModal', elementId: '#leaveModal');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset('isEdit', 'newLeaveInfo', 'startAt', 'endAt');
    }

    public function confirmDeleteLeave($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteLeave()
    {
        DB::table('employee_leave')->where('id', $this->confirmedId)->delete();
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
        $this->confirmedId = null; // Reset the confirmedId after deletion
    }

    public function showNewLeaveModal()
    {
        $this->reset('isEdit', 'selectedEmployeeId', 'newLeaveInfo', 'startAt', 'endAt');
    }

    // public function showEditLeaveModal($id)
    // {

    //     $this->reset('newLeaveInfo', 'startAt', 'endAt');

    //     $this->isEdit = true;
    //     $this->employee_leave_id = $id;

    //     // Fetch the leave record
    //     $leave = DB::table('employee_leave')->where('id', $this->employee_leave_id)->first();

    //     // Check if the leave record exists
    //     if (! $leave) {
    //         session()->flash('error', 'Leave record not found.');

    //         return;
    //     }

    //     // $employee = Employee::find($leave->employee_id);
    //     // $leaveType = Leave::find($leave->leave_id);
    //     $this->newLeaveInfo = [
    //         'LeaveId' => $leave->leave_id,
    //         'fromDate' => $leave->from_date,
    //         'toDate' => $leave->to_date,
    //     ];

    //     $employeeId = DB::table('employee_leave')->where('id', $this->employee_leave_id)->value('employee_id');
    //     $this->selectedEmployeeId = $employeeId;

    //     $leaveTypeName = Leave::find($leave->leave_id)->name;

    //     $this->startAt = $leave->start_at;
    //     $this->endAt = $leave->end_at;

    //     // $this->newLeaveInfo['fromDate'] = $leave->from_date;
    //     // $this->newLeaveInfo['toDate'] = $leave->to_date;
    //     // $this->startAt = $leave->start_at;
    //     // $this->endAt = $leave->end_at;

    //     // $this->dispatch('openModal', ['elementId' => '#leaveModal']);
    // }

    public function showEditLeaveModal($id)
    {
        $this->reset('newLeaveInfo', 'startAt', 'endAt', 'leaveTypeName', 'employeeName');

        $this->isEdit = true;
        $this->employee_leave_id = $id;

        // Fetch the leave record
        $leave = DB::table('employee_leave')->where('id', $this->employee_leave_id)->first();

        // Check if the leave record exists
        if (! $leave) {
            session()->flash('error', 'Leave record not found.');

            return;
        }

        // Set the leave information
        $this->newLeaveInfo = [
            'LeaveId' => $leave->leave_id,
            'fromDate' => $leave->from_date,
            'toDate' => $leave->to_date,
        ];

        $employeeId = DB::table('employee_leave')->where('id', $this->employee_leave_id)->value('employee_id');
        $this->selectedEmployeeId = $employeeId;

        // Fetch and set the employee name
        $this->employeeName = Employee::find($employeeId)->FullName;
        // Fetch and set the leave type name
        $this->leaveTypeName = Leave::find($leave->leave_id)->name;

        $this->startAt = $leave->start_at;
        $this->endAt = $leave->end_at;
    }
}
