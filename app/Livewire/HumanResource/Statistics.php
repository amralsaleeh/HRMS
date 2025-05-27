<?php

namespace App\Livewire\HumanResource;

use App\Exports\ExportDiscounts;
use App\Exports\ExportSummary;
use App\Models\Discount;
use App\Models\Employee;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Statistics extends Component
{
    public $batches;

    public $selectedBatch;

    public function mount()
    {
        $this->batches = Discount::where('batch', 'like', now()->year.'%')
            ->orderBy('batch', 'desc')
            ->distinct()
            ->pluck('batch')
            ->toArray();
        $this->selectedBatch = reset($this->batches);
    }

    public function render()
    {
        $employeeDiscounts = $this->getEmployeeDiscounts();

        return view('livewire.human-resource.statistics', ['employeeDiscounts' => $employeeDiscounts]);
    }

    public function getEmployeeDiscounts()
    {
        return Employee::whereHas('discounts', function ($query) {
            $query->where('batch', $this->selectedBatch);
        })
            ->with([
                'discounts' => function ($query) {
                    $query->where('batch', $this->selectedBatch);
                },
            ])
            ->get()
            ->each(function ($employee) {
                $employee->discounts = $employee->discounts->sortBy('date');
                $employee->cash_discounts_count = $employee->discounts
                    ->filter(function ($discount) {
                        return $discount->rate > 0;
                    })
                    ->count();
            })
            ->sortBy('first_name')
            ->sortByDesc('cash_discounts_count');
    }

    public function exportDiscounts()
    {
        return Excel::download(
            new ExportDiscounts($this->getEmployeeDiscounts()),
            'Discounts - '.$this->selectedBatch.'.xlsx'
        );
    }

    public function exportSummary()
    {
        return Excel::download(
            new ExportSummary($this->getEmployeeDiscounts()),
            'Summary - '.$this->selectedBatch.'.xlsx'
        );
    }
}
