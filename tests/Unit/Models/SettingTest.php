<?php

namespace Tests\Unit\Models;

use App\Models\Setting;
use Tests\TestCase;

class SettingTest extends TestCase
{

    public function test_fillable_attributes(): void
    {
        $setting = Setting::create([
            'sms_api_sender' => 'Sender',
            'sms_api_username' => 'user',
            'sms_api_password' => 'pass',
            'created_by' => 'System',
            'updated_by' => 'System',
        ]);

        $this->assertSame('Sender', $setting->sms_api_sender);
        $this->assertSame('user', $setting->sms_api_username);
    }
}
