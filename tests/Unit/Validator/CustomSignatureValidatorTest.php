<?php

namespace Tests\Unit\Validator;

use App\Validator\customSignatureValidator;
use Illuminate\Http\Request;
use Spatie\WebhookClient\Exceptions\InvalidConfig;
use Spatie\WebhookClient\WebhookConfig;
use Tests\TestCase;

class CustomSignatureValidatorTest extends TestCase
{
    private function makeConfig(string $signingSecret = 'secret', string $headerName = 'X-Hub-Signature'): WebhookConfig
    {
        $configArray = config('webhook-client.configs.0');
        $configArray['signing_secret'] = $signingSecret;
        $configArray['signature_header_name'] = $headerName;

        return new WebhookConfig($configArray);
    }

    public function test_returns_false_when_signature_header_missing(): void
    {
        $request = Request::create('/webhook', 'POST', [], [], [], [], 'payload');
        $config = $this->makeConfig();
        $validator = new customSignatureValidator;

        $this->assertFalse($validator->isValid($request, $config));
    }

    public function test_throws_when_signing_secret_empty(): void
    {
        $request = Request::create('/webhook', 'POST', [], [], [], ['HTTP_X-Hub-Signature' => 'sha1=abc'], 'payload');
        $config = $this->makeConfig('');
        $validator = new customSignatureValidator;

        $this->expectException(InvalidConfig::class);
        $this->expectExceptionMessage('signing secret is not set');

        $validator->isValid($request, $config);
    }

    public function test_returns_true_when_signature_valid(): void
    {
        $body = '{"event":"push"}';
        $secret = 'my-secret';
        $signature = 'sha1=' . hash_hmac('sha1', $body, $secret);

        $request = Request::create('/webhook', 'POST', [], [], [], [
            'HTTP_X-Hub-Signature' => $signature,
        ], $body);
        $config = $this->makeConfig($secret);
        $validator = new customSignatureValidator;

        $this->assertTrue($validator->isValid($request, $config));
    }

    public function test_returns_false_when_signature_invalid(): void
    {
        $body = '{"event":"push"}';
        $request = Request::create('/webhook', 'POST', [], [], [], [
            'HTTP_X-Hub-Signature' => 'sha1=wrong-signature',
        ], $body);
        $config = $this->makeConfig('my-secret');
        $validator = new customSignatureValidator;

        $this->assertFalse($validator->isValid($request, $config));
    }

    public function test_strips_sha1_prefix_from_header(): void
    {
        $body = 'payload';
        $secret = 'secret';
        $computed = hash_hmac('sha1', $body, $secret);
        $signature = 'sha1=' . $computed;

        $request = Request::create('/webhook', 'POST', [], [], [], [
            'HTTP_X-Hub-Signature' => $signature,
        ], $body);
        $config = $this->makeConfig($secret);
        $validator = new customSignatureValidator;

        $this->assertTrue($validator->isValid($request, $config));
    }
}
