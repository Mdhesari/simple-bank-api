<?php

namespace App\Services;

use App\DTO\AccountBalanceDTO;
use App\DTO\AccountDTO;
use App\Events\AccountBalanceDecreased;
use App\Events\AccountBalanceIncreased;
use App\Events\AccountCreated;
use App\Exceptions\AccountDecreaseBalanceException;
use App\Exceptions\AccountIncreaseBalanceException;
use App\Repositories\AccountRepositoryInterface;

class AccountService
{
    public function __construct(
        private AccountRepositoryInterface $accountRepo,
    )
    {
        //
    }

    public function create(AccountDTO $dto): \App\Models\Account
    {
        $account = $this->accountRepo->create($dto);

        event(new AccountCreated($account));

        return $account;
    }

    /**
     * @throws AccountDecreaseBalanceException
     */
    public function decreaseBalance(AccountBalanceDTO $dto)
    {
        $res = $this->accountRepo->decreaseBalance($dto);
        if (! $res) {

            throw new AccountDecreaseBalanceException;
        }

        event(new AccountBalanceDecreased($dto));
    }

    /**
     * @throws AccountIncreaseBalanceException
     */
    public function increaseBalance(AccountBalanceDTO $dto)
    {
        $res = $this->accountRepo->increaseBalance($dto);
        if (! $res) {

            throw new AccountIncreaseBalanceException;
        }

        event(new AccountBalanceIncreased($dto));
    }
}
