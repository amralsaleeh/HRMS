<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;

    // Variables - Start //

    // Variables - Start //

    public function render()
    {
        $employees = Employee::paginate(20);

        return view('livewire.human-resource.structure.employees', [
            'employees' => $employees, ]
        );
    }
}
