<?php

namespace App\Console\Commands;

use App\Models\BulkMessage;
use App\Traits\MessageProvider;
use Illuminate\Console\Command;

class SendUnsentBulkMessages extends Command
{
    use MessageProvider;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:send-unsent-bulk-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and send all unsent messages';

    /**
     * Execute the console command.
     */
    public function handle()
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
