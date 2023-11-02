<?php

namespace App\Livewire\HumanResource\Structure;

use Livewire\Component;

class Centers extends Component
{
    // Variables - Start //
    public $centers = [];

    public $name;

    public $supervisor;
    // Variables - End //

    public function render()
    {
        return view('livewire.human-resource.structure.centers');
    }

    public function addNewCenter()
    {
        $this->dispatch('toastr', type: 'success'/* , title: 'Done!' */ , message: 'Going Well!');
        // dd($this->name, $this->supervisor);

    }
}
