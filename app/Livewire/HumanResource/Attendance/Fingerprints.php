<?php

namespace App\Livewire\HumanResource\Attendance;

use App\Exports\ExportFingerprints;
use App\Imports\ImportFingerprints;
use App\Livewire\Sections\Navbar\Navbar;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Fingerprints extends Component
{
    use WithFileUploads, WithPagination;

    // Variables - Start //
    public $employees = [];

    public $selectedEmployee;

    public $selectedEmployeeId = 1;

    public $dateRange = '2023-10-01 to 2023-10-31';

    public $fromDate;

    public $toDate;

    public $isAbsence = false;

    public $isOneFingerprint = false;

    public $confirmedId;

    public $isEdit = false;

    public $fingerprint;

    #[Rule('required')]
    public $date;

    #[Rule('required')]
    public $check_in;

    #[Rule('required')]
    public $check_out;

    #[Rule('required', message: 'Please select a file to upload')]
    #[Rule('mimes:xlsx', message: 'Excel files is accepted only')]
    public $file;
    // Variables - End //

    public function mount()
    {
        $this->employees = Employee::all();

        $this->selectedEmployee = Employee::find(1);
    }

    public function render()
    {

        $fingerprints = $this->applyFilter();

        return view('livewire.human-resource.attendance.fingerprints', [
            'fingerprints' => $fingerprints,
        ]);
    }

    public function applyFilter()
    {
        // Employee
        $this->selectedEmployee = Employee::find($this->selectedEmployeeId);

        // Date range
        $dates = explode(' to ', $this->dateRange);

        $this->fromDate = $dates[0];
        $this->toDate = $dates[1];

        // Return filtered fingerprints
        return Fingerprint::filteredFingerprints(
            $this->selectedEmployee->id,
            $this->fromDate,
            $this->toDate,
            $this->isAbsence,
            $this->isOneFingerprint)->paginate(7);
    }

    public function importFromExcel()
    {
        // $this->validate();

        try {
            Excel::import(new ImportFingerprints(), $this->file);

            Notification::send(Auth::user(), new DefaultNotification(
                'Successfully imported the fingerprint file'
            ));
            $this->dispatch('refreshNotifications')->to(Navbar::class);

            session()->flash('success', 'Well done! The file has been imported successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Failure is not the end, reason: '.$e->getMessage());
        }

        $this->dispatch('closeModal', elementId: '#importModal');
    }

    public function exportToExcel()
    {
        $fingerprints = Fingerprint::filteredFingerprints(
            $this->selectedEmployee->id,
            $this->fromDate,
            $this->toDate,
            $this->isAbsence,
            $this->isOneFingerprint)->get();

        $fileName = 'Fingerprints - '.Carbon::now();

        return Excel::download(new ExportFingerprints($fingerprints), $fileName.'.xlsx');
    }

    //  start functions modal

    public function submitFingerprint()
    {
        $this->isEdit ? $this->editFingerprint() : $this->addFingerprint();
    }

    public function addFingerprint()
    {
        // $this->validate();

        Fingerprint::create([
            'employee_id' => '103',
            'is_checked' => '0',
            'date' => $this->date,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
        ]);

        $this->dispatch('closeModal', elementId: '#addRecordSidebar');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function editFingerprint()
    {
        // $this->validate();

        $this->fingerprint->update([
            'date' => $this->date,
            'check_in' => $this->check_in,
            'check_out' => $this->check_out,
        ]);

        $this->dispatch('closeModal', elementId: '#addRecordSidebar');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset();
    }

    public function confirmDeleteFingerprint($id)
    {
        $this->confirmedId = $id;
    }

    public function deleteFingerprint(Fingerprint $fingerprint)
    {
        $fingerprint->delete();
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function showNewFingerprintModal()
    {
        $this->reset();
    }

    public function showEditFingerprintModal(Fingerprint $fingerprint)
    {
        // $this->reset();
        $this->isEdit = true;

        $this->fingerprint = $fingerprint;

        $this->date = $fingerprint->date;
        $this->check_in = $fingerprint->check_in;
        $this->check_out = $fingerprint->check_out;

    }

    // end functions modal
}
