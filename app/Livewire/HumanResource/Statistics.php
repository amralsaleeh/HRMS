<?php

namespace App\Livewire\HumanResource;

use App\Exports\ExportDiscounts;
use App\Models\Discount;
use App\Models\Employee;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Statistics extends Component
{
    public $batches;

    public $employeeDiscounts;

    public $selectedBatch;

    public function mount()
    {
        $this->batches = Discount::where('is_sent', 0)->distinct()->pluck('batch')->toArray();
        $this->selectedBatch = end($this->batches);
    }

    public function render()
    {
        $employeeDiscounts = $this->getEmployeeDiscounts();

        return view('livewire.human-resource.statistics', ['employeeDiscounts' => $employeeDiscounts]);
    }

    public function getEmployeeDiscounts()
    {
        $this->employeeDiscounts = Employee::whereHas('discounts', function ($query) {
            $query->where('batch', $this->selectedBatch);
        })->with(['discounts' => function ($query) {
            $query->where('batch', $this->selectedBatch);
        }])->get()->each(function ($employee) {
            $employee->discounts = $employee->discounts->sortBy('date');
            $employee->cash_discounts_count = $employee->discounts->filter(function ($discount) {
                return $discount->rate > 0;
            })->count();
        })->sortBy('first_name')->sortByDesc('cash_discounts_count');

        return $this->employeeDiscounts;
    }

    public function exportDiscounts()
    {
        return Excel::download(new ExportDiscounts($this->employeeDiscounts), 'Discounts - '.$this->selectedBatch.'.xlsx');
    }
}
