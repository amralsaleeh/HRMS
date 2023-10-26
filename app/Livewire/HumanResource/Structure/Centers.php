<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Centers extends Component
{
    public $centers = [];

    public function render()
    {
        return view('livewire.human-resource.structure.centers');
    }
}
