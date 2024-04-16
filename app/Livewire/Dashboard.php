<?php

namespace App\Livewire;

use App\Jobs\sendPendingMessages;
use App\Models\Changelog;
use App\Models\Message;
use Illuminate\Support\Number;
use Livewire\Component;
use Throwable;

class Dashboard extends Component
{
    public $accountBalance = ['status' => 400, 'balance' => 'N/A', 'is_active' => 'N/A'];

    public $messagesStatus = ['sent' => 0, 'unsent' => 0];

    public $changelogs;

    public function mount()
    {
        try {
            $this->accountBalance = $this->CheckAccountBalance();
            $this->messagesStatus = Message::selectRaw('SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent, SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent')
                ->first();
            $this->messagesStatus = ['sent' => Number::format($this->messagesStatus['sent'] != null ? $this->messagesStatus['sent'] : 0), 'unsent' => Number::format($this->messagesStatus['unsent'] != null ? $this->messagesStatus['unsent'] : 0)];
        } catch (Throwable $th) {
            //
        }
        $this->changelogs = Changelog::all();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function sendPendingMessages()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessages::dispatch();
            session()->flash('info', "Let's go! Messages on their way!");
        } else {
            $this->dispatch('toastr', type: 'info'/* , title: 'Done!' */ , message: 'Everything has sent already!');
        }
    }
}
