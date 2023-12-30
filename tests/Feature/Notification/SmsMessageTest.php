<?php

use App\Notifications\Messages\SmsMessage;

it('can output text message', function () {
    $message = (new SmsMessage)
        ->line(__('sms.messages.deposit', [
            'quantity' => 12000,
        ]));

    $this->assertStringContainsString(12000, $message->getText());
});
