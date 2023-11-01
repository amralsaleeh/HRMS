<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Positions extends Component
{
    // Variables - Start //
    public $positions = [];
    // Variables - Start //

    public function render()
    {
        return view('livewire.human-resource.structure.positions');
    }
}
