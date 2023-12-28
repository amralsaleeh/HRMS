<?php

namespace App\Livewire\HumanResource;

use App\Models\Discount;
use App\Models\Employee;
use Livewire\Component;

class Statistics extends Component
{
    public $batches;

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
        return Employee::whereHas('discounts', function ($query) {
            $query->where('batch', $this->selectedBatch);
        })->with(['discounts' => function ($query) {
            $query->where('batch', $this->selectedBatch);
        }])->get()->each(function ($employee) {
            $employee->discounts = $employee->discounts->sortBy('date');
            $employee->cash_discounts_count = $employee->discounts->filter(function ($discount) {
                return $discount->rate > 0;
            })->count();
        })->sortBy('first_name');
    }
}
