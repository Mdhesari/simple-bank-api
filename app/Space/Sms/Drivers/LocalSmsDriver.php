<?php

namespace App\Space\Sms\Drivers;

use Illuminate\Log\LogManager;

class LocalSmsDriver implements SmsDriverInterface
{
    public function __construct(
        private LogManager $logManager
    )
    {
        //
    }

    public function send(string $receptor, string $message)
    {
        $this->logManager->info('sending sms to '.$receptor.' with message: '.$message);
    }
}
