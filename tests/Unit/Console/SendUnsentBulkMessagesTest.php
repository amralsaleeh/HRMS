<?php

namespace Tests\Unit\Console;

use App\Models\BulkMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SendUnsentBulkMessagesTest extends TestCase
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

    public function test_command_marks_message_sent_when_sms_succeeds(): void
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

        $this->artisan('messages:send-unsent-bulk-messages');

        $message->refresh();
        $this->assertTrue((bool) $message->is_sent);
        $this->assertNull($message->error);
    }

    public function test_command_marks_message_unsent_and_sets_error_when_sms_fails(): void
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

        $this->artisan('messages:send-unsent-bulk-messages');

        $message->refresh();
        $this->assertFalse((bool) $message->is_sent);
        $this->assertSame('Error', $message->error);
    }

    public function test_command_does_nothing_when_no_pending_messages(): void
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

        $this->artisan('messages:send-unsent-bulk-messages')
            ->assertSuccessful();
    }
}
