<?php

namespace App\Livewire\HumanResource\Messages;

use App\Jobs\sendPendingMessages;
use App\Jobs\sendPendingMessagesByWhatsapp;
use App\Models\Discount;
use App\Models\Employee;
use App\Models\Message;
use App\Traits\MessageProvider;
use Carbon\Carbon;
use Illuminate\Support\Number;
use Livewire\Component;
use Throwable;

class Personal extends Component
{
    use MessageProvider;

    // Variables - Start //
    public $accountBalance = ['status' => 400, 'balance' => '---', 'is_active' => '---'];

    public $messagesStatus = ['sent' => 0, 'unsent' => 0];

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
        $this->batches = Discount::where('is_sent', 0)
            ->distinct()
            ->pluck('batch')
            ->toArray();

        // try {
        //     $this->accountBalance = $this->CheckAccountBalance();
        // } catch (Throwable $th) {
        //     //
        // }
    }

    public function render()
    {
        $this->messagesStatus = Message::selectRaw(
            'SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent, SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent'
        )->first();
        $this->messagesStatus = [
            'sent' => Number::format($this->messagesStatus['sent'] != null ? $this->messagesStatus['sent'] : 0),
            'unsent' => Number::format($this->messagesStatus['unsent'] != null ? $this->messagesStatus['unsent'] : 0),
        ];

        $this->employees = Employee::where('id', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('first_name', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('last_name', 'like', '%'.$this->searchTerm.'%')
            ->get();
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

    public function generateMessages()
    {
        $employeesDiscounts = Employee::with([
            'timelines',
            'discounts' => function ($query) {
                $query->where('is_sent', 0)->where('batch', $this->selectedBatch);
            },
        ]) /* ->whereHas('timelines', function ($query) {
            $query->where('department_id', 1)->where('end_date', null);
        }) */
            ->where('is_active', 1)
            ->whereHas('contract', function ($query) {
                $query->where('work_rate', 100);
            })
            ->get();

        $dates = explode(' to ', $this->selectedBatch);

        foreach ($employeesDiscounts as $employee) {
            $cashDiscountCount = 0;

            if ($employee->discounts) {
                foreach ($employee->discounts as $discount) {
                    $discount->rate > 0 ? ++$cashDiscountCount : '';

                    $discount->is_sent = 1;
                    $discount->save();
                }

                $messageBody =
                  'عزيزي صاحب المعرف رقم ('.
                  $employee->id.
                  ')، يرجى الاطلاع على التفاصيل التالية وذلك لغاية ('.
                  $dates[1].
                  '):

- الحسم المالي: '.
                  $cashDiscountCount.
                  '

- رصيد الإجازات: '.
                  $employee->max_leave_allowed.
                  '
- عداد الساعات: '.
                  Carbon::parse($employee->hourly_counter)->format('H:i').
                  '
- عداد التأخير: '.
                  Carbon::parse($employee->delay_counter)->format('H:i').
                  '

وجودك مهم،
مشروع الحماية المجتمعية.';

                Message::create([
                    'employee_id' => $employee->id,
                    'text' => $messageBody,
                    'recipient' => $employee->mobile_number,
                    'is_sent' => false,
                ]);
            }
        }

        session()->flash('success', __('Generation complete! Your messages ready to fly!'));
        $this->batches = Discount::where('is_sent', 0)
            ->distinct()
            ->pluck('batch')
            ->toArray();
    }

    public function sendPendingMessages()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessages::dispatch();
            session()->flash('info', __("Let's go! Messages on their way!"));
        } else {
            $this->dispatch('toastr', type: 'info' /* , title: 'Done!' */, message: __('Everything has sent already!'));
        }
    }

    public function sendPendingMessagesByWhatsapp()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingMessagesByWhatsapp::dispatch();
            session()->flash('info', __("Let's go! Messages on their way!"));
        } else {
            $this->dispatch('toastr', type: 'info' /* , title: 'Done!' */, message: 'Everything has sent already!');
        }
    }
}
