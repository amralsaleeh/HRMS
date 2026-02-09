<?php

namespace Tests\Unit\Models;

use App\Models\BulkMessage;
use Tests\TestCase;

class BulkMessageTest extends TestCase
{

    public function test_fillable_attributes(): void
    {
        $message = BulkMessage::create([
            'text' => 'Hello',
            'numbers' => '963933697861',
            'is_sent' => false,
            'error' => null,
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('Hello', $message->text);
        $this->assertSame('963933697861', $message->numbers);
        $this->assertFalse($message->is_sent);
    }
}
