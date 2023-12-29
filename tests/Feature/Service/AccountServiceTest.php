<?php

use App\DTO\AccountDTO;
use App\Enums\AccountType;
use App\Models\User;
use App\Services\AccountService;

it('can create account', function () {
    $service = app(AccountService::class);

    $user = User::factory()->create();

    $accDTO = new AccountDTO(AccountType::Deposit, '6219861054580063', "IR123", 12000, $user->id);
    $accDTO = $service->create($accDTO);

    $this->assertNotNull($accDTO);
});
