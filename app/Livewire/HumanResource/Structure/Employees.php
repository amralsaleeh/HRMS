<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Employees extends Component
{
    // Variables - Start //
    public $employees = [];
    // Variables - Start //

    public function render()
    {
        return view('livewire.human-resource.structure.employees');
    }
}
