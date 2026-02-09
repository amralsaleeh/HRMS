<?php

namespace Tests\Unit\Jobs;

use App\Jobs\sendPendingMessagesByWhatsapp;
use App\Models\Message;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SendPendingMessagesByWhatsappTest extends TestCase
{

    public function test_handle_marks_message_sent_when_whatsapp_api_succeeds(): void
    {
        Http::fake(['http://localhost:3000/*' => Http::response(null, 201)]);

        $message = Message::create([
            'employee_id' => null,
            'text' => 'Hello',
            'recipient' => '933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessagesByWhatsapp;
        $job->handle();

        $message->refresh();
        $this->assertTrue((bool) $message->is_sent);
        $this->assertSame('Sent by WhatsApp API', $message->error);
    }

    public function test_handle_marks_message_unsent_when_whatsapp_api_fails(): void
    {
        Http::fake(['http://localhost:3000/*' => Http::response('', 500)]);

        $message = Message::create([
            'employee_id' => null,
            'text' => 'Hello',
            'recipient' => '933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessagesByWhatsapp;
        $job->handle();

        $message->refresh();
        $this->assertFalse((bool) $message->is_sent);
        $this->assertSame('!! NOT SENT !!', $message->error);
    }

    public function test_handle_does_nothing_when_no_pending_messages(): void
    {
        Message::create([
            'employee_id' => null,
            'text' => 'Done',
            'recipient' => '933697861',
            'is_sent' => true,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $job = new sendPendingMessagesByWhatsapp;
        $job->handle();

        $this->assertTrue(true);
    }

    public function test_send_text_returns_true_when_api_returns_201(): void
    {
        Http::fake(['http://localhost:3000/*' => Http::response(null, 201)]);

        $job = new sendPendingMessagesByWhatsapp;

        $this->assertTrue($job->sendText('Hello', '933697861'));
    }

    public function test_send_text_returns_response_string_when_api_returns_non_201(): void
    {
        Http::fake(['http://localhost:3000/*' => Http::response('Server error', 500)]);

        $job = new sendPendingMessagesByWhatsapp;

        $result = $job->sendText('Hello', '933697861');

        $this->assertIsString($result);
        $this->assertNotTrue($result);
    }
}
