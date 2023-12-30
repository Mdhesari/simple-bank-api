<?php

namespace App\Repositories\Eloquent;

use App\DTO\AccountBalanceDTO;
use App\DTO\AccountDTO;
use App\Models\Account;
use App\Repositories\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function __construct(
        private Account $entity
    )
    {
        //
    }

    /**
     * @param AccountDTO $dto
     * @return Account
     */
    public function create(AccountDTO $dto): Account
    {
        return $this->entity->create([
            'type'     => $dto->type,
            'quantity' => $dto->quantity,
            'user_id'  => $dto->userId,
        ]);
    }

    public function getById(int $id): Account
    {
        return $this->entity->find($id);
    }

    public function decreaseBalance(AccountBalanceDTO $dto): bool
    {
        $e = $this->getById($dto->accountId);

        return $e->update([
            'quantity' => floatval($e->quantity) - $dto->quantity,
        ]);
    }

    public function increaseBalance(AccountBalanceDTO $dto): bool
    {
        $e = $this->getById($dto->accountId);

        return $e->update([
            'quantity' => floatval($e->quantity) + $dto->quantity,
        ]);
    }
}
