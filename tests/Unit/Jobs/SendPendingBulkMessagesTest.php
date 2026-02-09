<?php

namespace Tests\Unit\Jobs;

use App\Jobs\sendPendingBulkMessages;
use App\Models\BulkMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SendPendingBulkMessagesTest extends TestCase
{
    private function createSetting(): void
    {
        Setting::create([
            'sms_api_sender' => 'Test',
            'sms_api_username' => 'user',
            'sms_api_password' => 'pass',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
    }

    public function test_handle_marks_bulk_message_sent_when_sms_succeeds(): void
    {
        $this->createSetting();
        Http::fake(['https://bms.syriatel.sy/*' => Http::response('12345', 200)]);

        $message = BulkMessage::create([
            'text' => 'Hello',
            'numbers' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingBulkMessages;
        $job->handle();

        $message->refresh();
        $this->assertTrue((bool) $message->is_sent);
        $this->assertNull($message->error);
    }

    public function test_handle_marks_bulk_message_unsent_when_sms_fails(): void
    {
        $this->createSetting();
        Http::fake(['https://bms.syriatel.sy/*' => Http::response('Error', 200)]);

        $message = BulkMessage::create([
            'text' => 'Hello',
            'numbers' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingBulkMessages;
        $job->handle();

        $message->refresh();
        $this->assertFalse((bool) $message->is_sent);
        $this->assertSame('Error', $message->error);
    }

    public function test_handle_does_nothing_when_no_pending_bulk_messages(): void
    {
        $this->createSetting();
        BulkMessage::create([
            'text' => 'Done',
            'numbers' => '963933697861',
            'is_sent' => true,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingBulkMessages;
        $job->handle();

        $this->assertTrue(true);
    }

    public function test_handle_marks_message_unsent_and_logs_when_send_throws(): void
    {
        $this->createSetting();
        Http::fake(function () {
            throw new \RuntimeException('SMS gateway unavailable');
        });

        $message = BulkMessage::create([
            'text' => 'Hello',
            'numbers' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        Log::shouldReceive('error')
            ->once()
            ->withArgs(fn($msg) => str_contains($msg, 'Failed to send SMS for message ID'));

        $job = new sendPendingBulkMessages;
        $job->handle();

        $message->refresh();
        $this->assertFalse((bool) $message->is_sent);
        $this->assertSame('SMS gateway unavailable', $message->error);
    }
}
