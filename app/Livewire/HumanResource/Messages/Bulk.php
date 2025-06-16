<?php

namespace App\Livewire\HumanResource\Messages;

use App\Jobs\sendPendingBulkMessages;
use App\Models\BulkMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Livewire\Component;

class Bulk extends Component
{
    // Variables - Start //
    public $messagesStatus = ['all' => 0, 'sent' => 0, 'unsent' => 0];

    public $numbersInput = '';

    public $messageText = '';

    public $numbers = [];

    public $validated = false;

    public $validationError = '';
    // Variables - End //

    public function updatedNumbersInput()
    {
        $this->validated = false;
        $this->validationError = '';
        $this->numbers = [];
    }

    public function validateNumbers()
    {
        if (trim($this->messageText) === '') {
            session()->flash('error', 'حقل الرسالة لا يمكن أن يكون فارغًا.');
            $this->dispatch('scroll-to-top');
            $this->validated = false;

            return;
        }

        $lines = explode("\n", $this->numbersInput);
        $cleaned = [];
        $seenNumbers = [];
        $filteredInput = [];

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            if ($trimmedLine === '') {
                continue;
            }

            $number = preg_replace('/\D/', '', $trimmedLine);

            if (! preg_match('/^9\d{8}$/', $number)) {
                session()->flash(
                    'error',
                    "الرقم التالي غير صحيح: $number. يشترط أن يبدأ بالرقم '9' وأن يكون طوله 9 أرقام بالضبط."
                );
                $this->dispatch('scroll-to-top');
                $this->validated = false;

                return;
            }

            if (in_array($number, $seenNumbers)) {
                session()->flash('error', "تم تكرار الرقم التالي: $number");
                $this->dispatch('scroll-to-top');
                $this->validated = false;

                return;
            }

            $seenNumbers[] = $number;
            $cleaned[] = '963'.$number.';';
            $filteredInput[] = $number;
        }

        $this->numbersInput = implode("\n", $filteredInput);

        $this->numbers = $cleaned;
        $this->validated = true;
    }

    public function send()
    {
        if (! $this->validated) {
            $this->addError('general', 'الرجاء التحقق من الأرقام أولاً.');

            return;
        }

        if (empty($this->messageText)) {
            $this->addError('general', 'نص الرسالة فارغ.');

            return;
        }

        BulkMessage::create([
            'text' => $this->messageText,
            'numbers' => implode('', $this->numbers),
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        session()->flash('success', 'هذا رائع! سيتم إرسال الرسائل قريباً.');
        $this->dispatch('scroll-to-top');

        $this->reset(['numbersInput', 'messageText', 'numbers', 'validated', 'validationError']);
    }

    public function render()
    {
        $this->messagesStatus = BulkMessage::where('created_by', Auth::user()->name)
            ->selectRaw(
                '
          SUM(CASE WHEN is_sent = 1 THEN 1 ELSE 0 END) AS sent,
          SUM(CASE WHEN is_sent = 0 THEN 1 ELSE 0 END) AS unsent,
          COUNT(*) AS `all`
          '
            )
            ->first();

        $this->messagesStatus = [
            'sent' => Number::format($this->messagesStatus->sent ?? 0),
            'unsent' => Number::format($this->messagesStatus->unsent ?? 0),
            'all' => Number::format($this->messagesStatus->all ?? 0),
        ];

        return view('livewire.human-resource.messages.bulk');
    }

    public function sendPendingBulkMessages()
    {
        if ($this->messagesStatus['unsent'] != 0) {
            sendPendingBulkMessages::dispatch();
            session()->flash('info', __("Let's go! Messages on their way!"));
        } else {
            $this->dispatch('toastr', type: 'info' /* , title: 'Done!' */, message: __('Everything has sent already!'));
        }
    }
}
