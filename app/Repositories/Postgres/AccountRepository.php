<?php

namespace App\Repositories\Postgres;

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
     */
    public function create(AccountDTO $dto)
    {
        $this->entity->create([
            'type'         => $dto->type,
            'card_number'  => $dto->cardNumber,
            'sheba_number' => $dto->shebaNumber,
            'quantity'     => $dto->quantity,
            'user_id'      => $dto->userId,
        ]);
    }
}
