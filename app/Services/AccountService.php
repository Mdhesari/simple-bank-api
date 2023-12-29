<?php

namespace App\Services;

use App\DTO\AccountDTO;
use App\Events\AccountCreated;
use App\Repositories\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        private AccountRepositoryInterface $accountRepo
    )
    {
        //
    }

    public function create(AccountDTO $accountDTO)
    {
        $account = $this->accountRepo->create($accountDTO);

        event(new AccountCreated($account));

        return $account;
    }
}
