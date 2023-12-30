<?php

use App\DTO\TransactionDTO;
use App\Enums\TransactionStatus;
use App\Events\TransactionCreated;
use App\Exceptions\AccountDecreaseBalanceException;
use App\Exceptions\AccountIncreaseBalanceException;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\TransactionFee;
use App\Models\User;
use Illuminate\Support\Facades\Event;

it(/**
 * @throws AccountIncreaseBalanceException
 * @throws AccountDecreaseBalanceException
 */ 'can deposit from source to destination', function () {
    $accFactory = Account::factory();
    $userFactory = User::factory();

    $accountSrc = $accFactory->has(CreditCard::factory())->create([
        'user_id'  => $userFactory->create()->id,
        'quantity' => 450000,
    ]);
    $creditCardSrc = $accountSrc->creditCards()->first();

    $accountDst = $accFactory->has(CreditCard::factory())->create([
        'user_id'  => $userFactory->create()->id,
        'quantity' => 5000,
    ]);
    $creditCardDst = $accountDst->creditCards()->first();

    $txSrv = getTransactionService();

    Event::fake(TransactionCreated::class);

    $dto = new TransactionDTO($qua = 145000, TransactionStatus::Success, $creditCardSrc->id, $creditCardDst->id);
    $tx = $txSrv->deposit($dto);

    Event::assertDispatched(TransactionCreated::class);

    $this->assertNotNull($tx->fresh());
    // source account gets a fee
    $this->assertEquals(TransactionFee::DEFAULT_FEE, $fee = $tx->fresh()->total_fee);
    $this->assertEquals($accountSrc->quantity - ($qua + $fee), $accountSrc->fresh()->quantity);
    $this->assertEquals($accountDst->quantity + $qua, $accountDst->fresh()->quantity);
});
