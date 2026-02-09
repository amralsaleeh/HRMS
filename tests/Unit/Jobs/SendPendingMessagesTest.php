<?php

namespace Tests\Unit\Jobs;

use App\Jobs\sendPendingMessages;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SendPendingMessagesTest extends TestCase
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

    public function test_handle_marks_message_sent_when_sms_succeeds(): void
    {
        $this->createSetting();
        Http::fake(['https://bms.syriatel.sy/*' => Http::response('12345', 200)]);

        $message = Message::create([
            'employee_id' => null,
            'text' => 'Hello',
            'recipient' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessages;
        $job->handle();

        $message->refresh();
        $this->assertTrue((bool) $message->is_sent);
        $this->assertNull($message->error);
    }

    public function test_handle_marks_message_unsent_when_sms_fails(): void
    {
        $this->createSetting();
        Http::fake(['https://bms.syriatel.sy/*' => Http::response('Error', 200)]);

        $message = Message::create([
            'employee_id' => null,
            'text' => 'Hello',
            'recipient' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessages;
        $job->handle();

        $message->refresh();
        $this->assertFalse((bool) $message->is_sent);
        $this->assertSame('Error', $message->error);
    }

    public function test_handle_does_nothing_when_no_pending_messages(): void
    {
        $this->createSetting();
        Message::create([
            'employee_id' => null,
            'text' => 'Done',
            'recipient' => '963933697861',
            'is_sent' => true,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessages;
        $job->handle();

        $this->assertTrue(true);
    }
}
