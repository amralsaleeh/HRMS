<?php

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

trait MessageProvider
{
    public function sendSms($messageBody = 'Test', $recipientNumbers = '963933697861')
    {
        $settings = Setting::first();

        $response = Http::get('https://bms.syriatel.sy/API/SendSMS.aspx?'.
          'user_name='.$settings->sms_api_username.
          '&password='.$settings->sms_api_password.
          '&msg='.$messageBody.
          '&sender='.$settings->sms_api_sender.
          '&to='.$recipientNumbers
        );

        if ($response->getStatusCode() == 200 && preg_match('/^[0-9]+$/', (string) $response)) {
            return 1;
        } else {
            return 0;
        }
        // return ['status' => $response->getStatusCode(), 'message' => (string) $response];
    }

    public function CheckAccountBalance()
    {
        $settings = Setting::first();

        $response = Http::get('https://bms.syriatel.sy/API/CheckUserStatus.aspx?'.
          'user_name='.$settings->sms_api_username.
          '&password='.$settings->sms_api_password.
          '&target_user_name='.$settings->sms_api_username
        );

        $pairs = explode(',', (string) $response);
        $data = [];
        foreach ($pairs as $pair) {
            [$key, $value] = explode(':', $pair);
            $data[$key] = $value;
        }

        return ['status' => $response->getStatusCode(), 'balance' => $data['SMSBalance'], 'is_active' => $data['Active']];
    }
}
