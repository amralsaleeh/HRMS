<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Members extends Component
{
    public $members = [];

    public function render()
    {
        return view('livewire.human-resource.structure.members');
    }
}
