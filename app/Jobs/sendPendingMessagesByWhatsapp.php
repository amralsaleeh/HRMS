<?php

namespace App\Jobs;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class sendPendingMessagesByWhatsapp implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $pendingMessages = Message::where('is_sent', 0)->get();

        foreach ($pendingMessages as $messages) {
            $response = $this->sendText($messages->text, $messages->recipient);
            // info($messages->recipient);
            if ($response == true) {
                $messages->update(['is_sent' => true, 'error' => 'Sent by WhatsApp API']);
            } else {
                $messages->update(['is_sent' => false, 'error' => '!! NOT SENT !!']);
            }
            sleep(1);
        }
    }

    public function sendText($messageBody = 'Test', $recipientNumbers = '933697861')
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://localhost:3000/api/sendText', [
            'session' => 'default',
            'chatId' => '963'.$recipientNumbers.'@c.us',
            'text' => $messageBody,
        ]);

        if ($response->getStatusCode() == 201) {
            return true;
        } else {
            return (string) $response;
        }
    }

    // https://waha.devlike.pro/docs/how-to/contacts/#check-phone-number-exists
    public function checkExists($recipientNumbers)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->get('http://localhost:3000/api/contacts/check-exists', [
            'session' => 'default',
            'phone' => $recipientNumbers,
        ]);

        dd($response);
    }
}
