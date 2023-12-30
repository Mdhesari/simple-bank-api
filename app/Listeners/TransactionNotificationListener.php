<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use App\Notifications\SendTransactionDepositNotification;
use App\Notifications\SendTransactionWithdrawNotification;

class TransactionNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionCreated $event): void
    {
        $srcUser = $event->transaction->srcCreditCard->account->user;
        $dstUser = $event->transaction->dstCreditCard->account->user;

        $srcUser->notify(new SendTransactionWithdrawNotification($event->transaction));
        $dstUser->notify(new SendTransactionDepositNotification($event->transaction));
    }
}
