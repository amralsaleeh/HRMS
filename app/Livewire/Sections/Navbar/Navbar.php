<?php

namespace App\Livewire\Sections\Navbar;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $unreadNotifications;

    public function render()
    {
        $this->unreadNotifications = auth()->user()->unreadNotifications;

        return view('livewire.sections.navbar.navbar');
    }

    #[On('refreshNotifications')]
    public function refresh()
    {
        $this->unreadNotifications = auth()->user()->unreadNotifications;
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = Auth::user()->unreadNotifications->where('id', $notificationId)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        $this->dispatch('refreshNotifications')->self();
    }

    public function markAllNotificationsAsRead()
    {
        $user = User::find(auth()->user()->id);

        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    }
}
