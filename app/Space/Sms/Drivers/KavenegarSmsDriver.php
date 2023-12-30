<?php

namespace App\Space\Sms\Drivers;

use Kavenegar\KavenegarApi;

class KavenegarSmsDriver implements SmsDriverInterface
{
    private KavenegarApi $client;

    private array $config;

    public function __construct()
    {
        $this->config = config('sms.drivers.kavenegar');
        $this->client = new KavenegarApi($this->config['apikey'], $this->config['insecure']);
    }

    public function send(string $receptor, string $message)
    {
        return $this->client->Send($this->config['line'], '9128177871', $message);
    }
}
