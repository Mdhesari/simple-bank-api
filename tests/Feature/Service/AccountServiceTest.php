<?php

use App\DTO\AccountDTO;
use App\Enums\AccountType;
use App\Models\User;

it('can create account', function () {
    $accSrv = getAccountService();

    $user = User::factory()->create();

    $accDTO = new AccountDTO(AccountType::Deposit, 12000, $user->id);
    $acc = $accSrv->create($accDTO);

    $this->assertNotNull($acc->fresh());
});
