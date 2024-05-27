<?php

namespace App\Jobs;

use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Symfony\Component\Process\Process;

class syncAppWithGithub extends ProcessWebhookJob
{
    public function handle()
    {
        // $this->webhookCall // contains an instance of `WebhookCall`

        $process = new Process(['git', 'pull']);
        info("Start deploy process - Running 'git pull'");

        $process->run(function ($type, $buffer) {

            if ($buffer == "Already up to date.\n") {
                $alreadyUpToDate = true;
            }

        });

        info('Deploy Complete Successfully');
    }
}
