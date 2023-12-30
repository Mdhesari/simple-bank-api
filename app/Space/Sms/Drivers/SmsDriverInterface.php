<?php

namespace App\Space\Sms\Drivers;

interface SmsDriverInterface
{
    public function send(string $receptor, string $message);
}
