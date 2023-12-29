<?php

use App\DTO\TransactionDTO;
use App\Enums\TransactionStatus;
use App\Events\TransactionCreated;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Event;

it('can deposit from X to Y', function () {
    $accFactory = Account::factory();
    $userFactory = User::factory();
    $accX = $accFactory->create([
        'user_id' => $userFactory->create()->id,
    ]);
    $accY = $accFactory->create([
        'user_id' => $userFactory->create()->id,
    ]);

    $txSrv = getTransactionService();

    Event::fake(TransactionCreated::class);

    $dto = new TransactionDTO(145000, TransactionStatus::Success, $accX->id, $accY->id);
    $tx = $txSrv->deposit($dto);

    Event::assertDispatched(TransactionCreated::class);

    $this->assertNotNull($tx->fresh());
});
