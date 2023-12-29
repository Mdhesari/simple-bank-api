<?php

namespace App\Repositories;

use App\DTO\AccountDTO;
use App\Models\Account;

interface AccountRepositoryInterface
{
    public function create(AccountDTO $dto): Account;
}
