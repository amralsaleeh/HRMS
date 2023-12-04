<?php

namespace App\Livewire\HumanResource\Structure;

use App\Models\Employee;
use Livewire\Component;

class EmployeeInfo extends Component
{
    public $employee;

    public function mount($id)
    {
        $this->employee = Employee::find($id);
    }

    public function render()
    {
        return view('livewire.human-resource.structure.employee-info');
    }
}
