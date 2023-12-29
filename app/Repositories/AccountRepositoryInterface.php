<?php

namespace App\Repositories;

use App\DTO\AccountDTO;

interface AccountRepositoryInterface
{
    public function create(AccountDTO $dto);
}
