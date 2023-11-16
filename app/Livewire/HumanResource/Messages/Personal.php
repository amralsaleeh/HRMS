<?php

namespace App\Livewire\HumanResource\Messages;

use App\Models\Employee;
use App\Models\Message;
use App\Traits\MessageProvider;
use Livewire\Component;

class Personal extends Component
{
    use MessageProvider;

    // Variables - Start //
    public $employees = [];

    public $searchTerm;

    public Employee $selectedEmployee;

    public $messages = [];

    public $messageBody;
    // Variables - End //

    public function mount()
    {
        $this->selectedEmployee = Employee::first();
    }

    public function render()
    {
        // $this->checkBalance();
        // $this->sendMessage('TEST FROM LIVEWIRE');

        $this->employees = Employee::where('first_name', 'like', '%'.$this->searchTerm.'%')->get();
        $this->messages = Message::where('employee_id', $this->selectedEmployee->id)->get();

        $this->dispatch('initialize');

        return view('livewire.human-resource.messages.personal');
    }

    public function selectEmployee(Employee $employee)
    {
        $this->selectedEmployee = $employee;
        $this->messages = Message::where('employee_id', $this->selectedEmployee->id)->get();
    }

    public function sendMessage()
    {
        $sms = Message::create([
            'employee_id' => $this->selectedEmployee->id,
            'text' => $this->messageBody,
            'recipient' => $this->selectedEmployee->mobile_number,
            'is_sent' => false,
        ]);

        $response = $this->sendSms($this->messageBody, $this->selectedEmployee->mobile_number);

        if ($response === true) {
            $sms->update(['is_sent' => true, 'error' => null]);
            $this->dispatch('playMessageSound');
        } else {
            $sms->update(['is_sent' => false, 'error' => $response]);
            $this->dispatch('playErrorSound');
        }

        $this->reset('messageBody');
    }
}
