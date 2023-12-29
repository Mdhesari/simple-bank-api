<?php

use App\DTO\TransactionDTO;
use App\Enums\TransactionStatus;
use App\Events\TransactionCreated;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Event;

it('can deposit from source to destination', function () {
    $accFactory = Account::factory();
    $userFactory = User::factory();
    $accSrc = $accFactory->create([
        'user_id'  => $userFactory->create()->id,
        'quantity' => 450000,
    ]);
    $accDst = $accFactory->create([
        'user_id'  => $userFactory->create()->id,
        'quantity' => 5000,
    ]);

    $txSrv = getTransactionService();

    Event::fake(TransactionCreated::class);

    $dto = new TransactionDTO($qua = 145000, TransactionStatus::Success, $accSrc->id, $accDst->id);
    $tx = $txSrv->deposit($dto);

    Event::assertDispatched(TransactionCreated::class);

    $this->assertNotNull($tx->fresh());
    $this->assertEquals($accSrc->quantity - $qua, $accSrc->fresh()->quantity);
    $this->assertEquals($accDst->quantity + $qua, $accDst->fresh()->quantity);
});
