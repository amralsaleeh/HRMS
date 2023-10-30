<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Positions extends Component
{
    public $positions = [];

    public function render()
    {
        return view('livewire.human-resource.structure.positions');
    }
}
