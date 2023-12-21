<?php

namespace App\Livewire\HumanResource;

use App\Models\Discount;
use App\Models\Employee;
use App\Models\Message;
use App\Traits\MessageProvider;
use Illuminate\Support\Number;
use Livewire\Component;

class Messages extends Component
{
    use MessageProvider;

    // Variables - Start //
    public $accountBalance = ['status' => 400, 'balance' => 'N/A', 'is_active' => 'N/A'];

    public $messagesStatus = [];

    public $batches;

    public $selectedBatch;

    public $employees = [];

    public $searchTerm;

    public Employee $selectedEmployee;

    public $messages = [];

    public $messageBody;
    // Variables - End //

    public function mount()
    {
        $this->selectedEmployee = Employee::first();
        $this->batches = Discount::distinct()->pluck('batch')->toArray();
    }

    public function render()
    {
        try {
            // $this->accountBalance = $this->CheckAccountBalance();
            $this->messagesStatus = Message::selectRaw('SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent, SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent')
                ->first();
            $this->messagesStatus = ['sent' => Number::format($this->messagesStatus['sent']), 'unsent' => Number::format($this->messagesStatus['unsent'])];
        } catch (\Throwable $th) {
            //
        }

        $this->employees = Employee::where('first_name', 'like', '%'.$this->searchTerm.'%')->get();
        $this->messages = Message::where('employee_id', $this->selectedEmployee->id)->get();

        $this->dispatch('initialize');

        return view('livewire.human-resource.messages');
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

    public function generateMessages()
    {
        $discounts = Discount::where('batch', $this->selectedBatch)->get();
        $groupedDiscounts = $discounts->groupBy('employee_id');

        foreach ($groupedDiscounts as $employee) {
            foreach ($employee as $discount) {
                dd($discount);
            }

            // $sms = Message::create([
            //     'employee_id' => $this->employee->id,
            //     'text' => $this->messageBody,
            //     'recipient' => $this->employee->mobile_number,
            //     'is_sent' => false,
            // ]);
            // $response = $this->sendSms($this->messageBody, $this->employee->mobile_number);
        }

        // DONE
    }
}
