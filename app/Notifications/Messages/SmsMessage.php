<?php

namespace App\Notifications\Messages;

class SmsMessage
{
    private array $messages;

    public function line(string $message): static
    {
        $this->messages[] = $message;

        return $this;
    }

    public function getText(): string
    {
        return implode(PHP_EOL, $this->messages);
    }
}
