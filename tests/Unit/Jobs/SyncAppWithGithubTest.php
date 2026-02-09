<?php

namespace Tests\Unit\Jobs;

use App\Jobs\syncAppWithGithub;
use Spatie\WebhookClient\Models\WebhookCall;
use Tests\TestCase;

class SyncAppWithGithubTest extends TestCase
{

    public function test_handle_runs_without_exception(): void
    {
        $webhookCall = WebhookCall::create([
            'name' => 'github',
            'url' => 'https://example.com/webhook',
            'headers' => [],
            'payload' => [],
        ]);

        $job = new syncAppWithGithub($webhookCall);
        $job->handle();

        $this->assertTrue(true);
    }
}
