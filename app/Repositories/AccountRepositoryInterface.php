<?php

namespace App\Repositories;

use App\DTO\AccountBalanceDTO;
use App\DTO\AccountDTO;
use App\Models\Account;

interface AccountRepositoryInterface
{
    public function create(AccountDTO $dto): Account;

    public function getById(int $id): Account;

    public function decreaseBalance(AccountBalanceDTO $dto): bool;

    public function increaseBalance(AccountBalanceDTO $dto): bool;
}
