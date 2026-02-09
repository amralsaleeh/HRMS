<?php

namespace Tests\Unit\Traits;

use App\Console\Commands\SendUnsentBulkMessages;
use App\Models\BulkMessage;
use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class MessageProviderTest extends TestCase
{

    private function createSetting(): void
    {
        Setting::create([
            'sms_api_sender' => 'TestSender',
            'sms_api_username' => 'user',
            'sms_api_password' => 'pass',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);
    }

    public function test_send_sms_returns_true_when_200_and_numeric_body(): void
    {
        $this->createSetting();
        Http::fake([
            'https://bms.syriatel.sy/*' => Http::response('12345', 200),
        ]);

        $command = new SendUnsentBulkMessages;
        $result = $command->sendSms('Hello', '963933697861');

        $this->assertTrue($result);
    }

    public function test_send_sms_returns_response_string_when_non_numeric(): void
    {
        $this->createSetting();
        Http::fake([
            'https://bms.syriatel.sy/*' => Http::response('Error: Invalid', 200),
        ]);

        $command = new SendUnsentBulkMessages;
        $result = $command->sendSms('Hello', '963933697861');

        $this->assertSame('Error: Invalid', $result);
    }

    public function test_send_sms_returns_response_string_when_not_200(): void
    {
        $this->createSetting();
        Http::fake([
            'https://bms.syriatel.sy/*' => Http::response('Server Error', 500),
        ]);

        $command = new SendUnsentBulkMessages;
        $result = $command->sendSms('Hello', '963933697861');

        $this->assertSame('Server Error', $result);
    }

    public function test_check_account_balance_returns_status_balance_and_active(): void
    {
        $this->createSetting();
        Http::fake([
            'https://bms.syriatel.sy/*' => Http::response('SMSBalance:100,Active:true', 200),
        ]);

        $command = new SendUnsentBulkMessages;
        $result = $command->CheckAccountBalance();

        $this->assertSame(200, $result['status']);
        $this->assertArrayHasKey('balance', $result);
        $this->assertSame('Active', $result['is_active']);
    }

    public function test_check_account_balance_returns_inactive_when_active_empty(): void
    {
        $this->createSetting();
        Http::fake([
            'https://bms.syriatel.sy/*' => Http::response('SMSBalance:0,Active:', 200),
        ]);

        $command = new SendUnsentBulkMessages;
        $result = $command->CheckAccountBalance();

        $this->assertSame('Inactive', $result['is_active']);
    }
}
