<?php

namespace App\Jobs;

use App\Models\BulkMessage;
use App\Traits\MessageProvider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendPendingBulkMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, MessageProvider, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $pendingMessages = BulkMessage::where('is_sent', 0)->get();

        foreach ($pendingMessages as $messages) {
            $response = $this->sendSms($messages->text, $messages->numbers);
            if ($response === true) {
                $messages->update(['is_sent' => true, 'error' => null]);
            } else {
                $messages->update(['is_sent' => false, 'error' => $response]);
            }
        }
    }
}
