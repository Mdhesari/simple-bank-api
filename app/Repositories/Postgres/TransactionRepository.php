<?php

namespace App\Repositories\Postgres;

use App\DTO\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(
        private Transaction $entity
    )
    {
        //
    }

    public function deposit(TransactionDTO $dto): Transaction
    {
        return $this->entity->create([
            'status'         => $dto->status,
            'quantity'       => $dto->quantity,
            'src_account_id' => $dto->srcAccountId,
            'dst_account_id' => $dto->dstAccountId,
        ]);
    }
}
