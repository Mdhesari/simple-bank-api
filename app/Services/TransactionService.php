<?php

namespace App\Services;

use App\DTO\TransactionDTO;
use App\Events\TransactionCreated;
use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(
        private TransactionRepositoryInterface $repo
    )
    {
        //
    }

    public function deposit(TransactionDTO $dto): \App\Models\Transaction
    {
        $transaction = $this->repo->deposit($dto);

        event(new TransactionCreated($transaction));

        return $transaction;
    }
}
