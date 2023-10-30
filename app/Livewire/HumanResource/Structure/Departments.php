<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Departments extends Component
{
    public $departments = [];

    public function render()
    {
        return view('livewire.human-resource.structure.departments');
    }
}
