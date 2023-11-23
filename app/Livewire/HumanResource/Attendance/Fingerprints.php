<?php

namespace App\Livewire\HumanResource\Attendance;

use App\Exports\ExportFingerprints;
use App\Imports\ImportFingerprints;
use App\Models\Employee;
use App\Models\Fingerprint;
use Carbon\Carbon;
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

    public $is_absence = false;

    public $is_oneFingerprint = false;

    public $confirmedId;

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
            $this->is_absence,
            $this->is_oneFingerprint)->paginate(7);
    }

    public function importFromExcel()
    {
        $this->validate();

        try {
            Excel::import(new ImportFingerprints(), $this->file);
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
            $this->is_absence,
            $this->is_oneFingerprint)->get();

        $fileName = 'Fingerprints - '.Carbon::now();

        return Excel::download(new ExportFingerprints($fingerprints), $fileName.'.xlsx');
    }
}
