<?php

namespace App\Livewire\HumanResource;

use App\Jobs\calculateDiscountsAsDays;
use App\Livewire\Sections\Navbar\Navbar;
use App\Models\Discount;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Discounts extends Component
{
    // Variables - Start //
    public $disableDateLimit;

    public $batch;

    public $isProcessing = false;

    public $percentage = 0;

    public $showDiscounts = false;
    // Variables - End //

    public function mount()
    {
        $this->disableDateLimit = substr(Discount::latest()->first()?->batch, -10);
    }

    public function render()
    {
        // $employeeDiscounts = $this->getEmployeeDiscounts();
        $employeeDiscounts = null;

        return view('livewire.human-resource.discounts', ['employeeDiscounts' => $employeeDiscounts]);
    }

    public function calculateDiscounts()
    {
        $this->validate(
            [
                'batch' => 'required',
            ],
            [
                'batch.required' => 'Please select the period you want to apply the discount on',
            ]
        );

        calculateDiscountsAsDays::dispatch(Auth::user(), $this->batch);

        $this->isProcessing = true;
    }

    public function updateProgressBar()
    {
        $job = DB::table('jobs')
            ->orderBy('id', 'desc')
            ->first();

        if ($job) {
            $this->percentage = $job->progress;
        } else {
            $this->isProcessing = false;
            $this->percentage = 0;
            session()->flash('success', __('Boom! Discounts calculations done and dusted — easy peasy!'));

            $this->showDiscounts = true;

            // $this->dispatch('refreshNotifications')->to(Navbar::class);
            // $this->render();
        }
    }

    public function getEmployeeDiscounts()
    {
        return Employee::whereHas('discounts', function ($query) {
            $query->whereBetween('date', explode(' to ', $this->batch));
        })
            ->with([
                'discounts' => function ($query) {
                    $query->whereBetween('date', explode(' to ', $this->batch));
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
            ->sortBy('first_name');
    }
}
