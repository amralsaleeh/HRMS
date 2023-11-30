<?php

namespace App\Livewire\HumanResource\Attendance;

use App\Exports\ExportFingerprints;
use App\Imports\ImportFingerprints;
use App\Imports\ImportFingerprintsOldTemplate;
use App\Livewire\Sections\Navbar\Navbar;
use App\Models\Employee;
use App\Models\Fingerprint;
use App\Notifications\DefaultNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Livewire\Attributes\Renderless;
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

    public $date;

    public $checkIn;

    public $checkOut;

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

    public function submitFingerprint()
    {
        $this->isEdit ? $this->editFingerprint() : $this->addFingerprint();
    }

    #[Renderless]
    public function showNewFingerprintModal()
    {
        $this->reset('isEdit', 'date', 'checkIn', 'checkOut');
    }

    #[Renderless]
    public function showEditFingerprintModal(Fingerprint $fingerprint)
    {
        $this->isEdit = true;

        $this->fingerprint = $fingerprint;

        $this->date = $fingerprint->date;
        $this->checkIn = $fingerprint->check_in;
        $this->checkOut = $fingerprint->check_out;
    }

    public function addFingerprint()
    {
        $this->validate([
            'date' => 'required',
            'checkIn' => 'required',
            'checkOut' => 'required',
        ]);

        Fingerprint::create([
            'employee_id' => $this->selectedEmployeeId,
            'date' => $this->date,
            'check_in' => $this->checkIn,
            'check_out' => $this->checkOut,
        ]);

        $this->dispatch('closeCanvas', elementId: '#addRecordSidebar');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
    }

    public function editFingerprint()
    {
        $this->validate([
            'date' => 'required',
            'checkIn' => 'required',
            'checkOut' => 'required',
        ]);

        $this->fingerprint->update([
            'date' => $this->date,
            'check_in' => $this->checkIn,
            'check_out' => $this->checkOut,
        ]);

        $this->dispatch('closeCanvas', elementId: '#addRecordSidebar');
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');

        $this->reset('isEdit', 'date', 'checkIn', 'checkOut');
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

    public function importFromExcel()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx',
        ], [
            'file.required' => 'Please select a file to upload',
            'file.mimes' => 'Excel files is accepted only',
        ]);

        try {
            Excel::import(new ImportFingerprints(), $this->file);

            Notification::send(Auth::user(), new DefaultNotification(
                'Successfully imported the fingerprint file'
            ));
            $this->dispatch('refreshNotifications')->to(Navbar::class);

            session()->flash('success', 'Well done! The file has been imported successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred: '.$e->getMessage());
        }

        $this->dispatch('closeModal', elementId: '#importModal');
    }

    public function importFromExcelOldTemplate()
    {
        $this->validate([
            'file' => 'required|mimes:xlsx',
        ], [
            'file.required' => 'Please select a file to upload',
            'file.mimes' => 'Excel files is accepted only',
        ]);

        try {
            Excel::import(new ImportFingerprintsOldTemplate(), $this->file);

            Notification::send(Auth::user(), new DefaultNotification(
                'Successfully imported the fingerprint file'
            ));
            $this->dispatch('refreshNotifications')->to(Navbar::class);

            session()->flash('success', 'Well done! The file has been imported successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error occurred: '.$e->getMessage());
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
}
