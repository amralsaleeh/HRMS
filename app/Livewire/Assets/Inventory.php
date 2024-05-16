<?php

namespace App\Livewire\Assets;

use App\Models\Asset;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    // 👉 Variables
    public $search_term = null;

    public $colors = [
        'Good' => 'success',
        'Fine' => 'primary',
        'Bad' => 'warning',
        'Damaged' => 'danger',
    ];

    public function render()
    {
        $assets = Asset::where('id', 'like', '%'.$this->search_term.'%')
            ->orWhere('old_id', 'like', '%'.$this->search_term.'%')
            ->orWhere('serial_number', 'like', '%'.$this->search_term.'%')
            ->paginate(6);

        return view('livewire.assets.inventory', [
            'assets' => $assets, ]);
    }

    public function showAsset()
    {
        dd('Show The Asset Model');
    }
}
