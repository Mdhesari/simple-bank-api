<?php

use App\Events\TransactionCreated;
use App\Listeners\TransactionNotificationListener;
use App\Models\Transaction;
use App\Notifications\SendTransactionDepositNotification;
use App\Notifications\SendTransactionWithdrawNotification;
use Illuminate\Support\Facades\Notification;

it('can send notifications to source and destination', function () {
    Notification::fake();

    $srcUser = createUser();
    $dstUser = createUser();

    $transaction = Transaction::factory()->create([
        'src_credit_card_id' => $srcUser->accounts()->first()->creditCards()->first()->id,
        'dst_credit_card_id' => $dstUser->accounts()->first()->creditCards()->first()->id,
    ]);

    $event = new TransactionCreated($transaction);
    $listener = new TransactionNotificationListener();

    $listener->handle($event);

    Notification::assertSentTo($srcUser, SendTransactionWithdrawNotification::class);
    Notification::assertSentTo($dstUser, SendTransactionDepositNotification::class);
});
