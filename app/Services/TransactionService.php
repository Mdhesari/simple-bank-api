<?php

namespace App\Services;

use App\DTO\TransactionDTO;
use App\DTO\TransactionFeeDTO;
use App\Events\TransactionCreated;
use App\Models\TransactionFee;
use App\Repositories\TransactionFeeRepositoryInterface;
use App\Repositories\TransactionRepositoryInterface;

class TransactionService
{
    public function __construct(
        private TransactionRepositoryInterface    $transactionRepo,
        private TransactionFeeRepositoryInterface $transactionFeeRepo
    )
    {
        //
    }

    public function deposit(TransactionDTO $dto): \App\Models\Transaction
    {
        $transaction = $this->transactionRepo->deposit($dto);

        $this->transactionFeeRepo->create(new TransactionFeeDTO(
            TransactionFee::DEFAULT_FEE, $dto->srcAccountId, $transaction->id,
        ));

        event(new TransactionCreated($transaction));

        return $transaction;
    }
}
