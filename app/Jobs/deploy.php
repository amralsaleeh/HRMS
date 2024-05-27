<?php

namespace App\Jobs;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob as SpatieProcessWebhookJob;

class deploy extends SpatieProcessWebhookJob
{
    public function handle()
    {
        // $this->webhookCall // contains an instance of `WebhookCall`

        // perform the work here

    }
}
