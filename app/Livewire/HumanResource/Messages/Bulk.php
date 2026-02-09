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
            session()->flash('error', __('Message field cannot be empty.'));
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
                    __("Invalid number: :number. Must start with '9' and be exactly 9 digits.", ['number' => $number])
                );
                $this->dispatch('scroll-to-top');
                $this->validated = false;

                return;
            }

            if (in_array($number, $seenNumbers)) {
                session()->flash('error', __('Duplicate number: :number', ['number' => $number]));
                $this->dispatch('scroll-to-top');
                $this->validated = false;

                return;
            }

            $seenNumbers[] = $number;
            $cleaned[] = '963' . $number . ';';
            $filteredInput[] = $number;

            if (count($cleaned) > 50) {
                session()->flash('error', __('Please enter at most 50 numbers.'));
                $this->dispatch('scroll-to-top');
                $this->validated = false;

                return;
            }
        }

        $this->numbersInput = implode("\n", $filteredInput);

        $this->numbers = $cleaned;
        $this->validated = true;
    }

    public function send()
    {
        if (! $this->validated) {
            $this->addError('general', __('Please validate the numbers first.'));

            return;
        }

        if (empty($this->messageText)) {
            $this->addError('general', __('Message text is empty.'));

            return;
        }

        BulkMessage::create([
            'text' => $this->messageText,
            'numbers' => implode('', $this->numbers),
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
        ]);

        session()->flash('success', __('Great! Messages will be sent shortly.'));
        $this->dispatch('scroll-to-top');

        $this->reset(['numbersInput', 'messageText', 'numbers', 'validated', 'validationError']);
    }

    public function render()
    {
        $createdBy = Auth::user()->name;

        $sent = BulkMessage::where('created_by', $createdBy)
            ->where('is_sent', 1)
            ->count();
        $unsent = BulkMessage::where('created_by', $createdBy)
            ->where('is_sent', 0)
            ->count();
        $all = BulkMessage::where('created_by', $createdBy)->count();

        $this->messagesStatus = [
            'sent' => Number::format($sent ?? 0),
            'unsent' => Number::format($unsent ?? 0),
            'all' => Number::format($all ?? 0),
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
