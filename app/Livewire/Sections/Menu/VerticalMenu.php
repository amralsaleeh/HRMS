<?php

namespace App\Livewire\Sections\Menu;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerticalMenu extends Component
{
    public $role = null;

    public function mount()
    {
        $this->role = User::find(Auth::id())?->getRoleNames()->first();
    }

    public function render()
    {
        return view('livewire.sections.menu.vertical-menu');
    }
}
