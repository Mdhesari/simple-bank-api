<?php

namespace App\Channel;

use App\Space\Sms\Drivers\SmsDriverInterface;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function send(object $notifiable, Notification $notification)
    {
        $message = $notification->ToSms($notifiable);

        $this->driver()->send($notifiable->mobile, $message->getText());
    }

    private function driver()
    {
        return app(SmsDriverInterface::class);
    }
}
