<?php

use App\DTO\AccountDTO;
use App\Enums\AccountType;
use App\Models\Account;
use App\Models\User;

it('can create account', function () {
    $accSrv = getAccountService();

    $user = User::factory()->create();

    $accDTO = new AccountDTO(AccountType::Deposit, '6219861054580063', "IR123", 12000, $user->id);
    $acc = $accSrv->create($accDTO);

    $this->assertNotNull($acc->fresh());
});
