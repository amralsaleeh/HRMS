<?php

namespace App\Livewire\HumanResource\Attendance;

use App\Imports\ImportLeaves;
use App\Livewire\Sections\Navbar\Navbar;
use App\Models\Employee;
use App\Models\Leave;
use App\Notifications\DefaultNotification;
use Exception;
use Illuminate\Support\Facades\Auth;
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

    // Variables - Start //
    public $employees = [];

    public $selectedEmployee;

    public $selectedEmployeeId = 1;

    public $dateRange = '2023-10-01 to 2023-12-01';

    public $fromDate;

    public $toDate;

    public $leaveTypes;

    public $selectedLeave;

    public $selectedLeaveId;

    public $confirmedId;

    public $file;
    // Variables - End //

    public function mount()
    {
        $this->employees = Employee::all();
        $this->selectedEmployee = Employee::find(1);

        $this->leaveTypes = Leave::all();
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
        // Employee
        $this->selectedEmployee = Employee::find($this->selectedEmployeeId);

        // Leave type
        $this->selectedLeave = Leave::find($this->selectedLeaveId);

        // Date range
        $dates = explode(' to ', $this->dateRange);

        $this->fromDate = $dates[0];
        $this->toDate = $dates[1];

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

    public function importFromExcel()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx',
        ], [
            'file.required' => 'Please select a file to upload',
            'file.mimes' => 'Excel files is accepted only',
        ]);

        try {
            Excel::import(new ImportLeaves(), $this->file);

            Notification::send(Auth::user(), new DefaultNotification(
                'Successfully imported the leaves file'
            ));
            $this->dispatch('refreshNotifications')->to(Navbar::class);

            session()->flash('success', 'Well done! The file has been imported successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Error occurred: '.$e->getMessage());
        }

        $this->dispatch('closeModal', elementId: '#importModal');
    }
}
