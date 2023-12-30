<?php

namespace App\Repositories\Eloquent;

use App\DTO\TransactionFeeDTO;
use App\Models\TransactionFee;
use App\Repositories\TransactionFeeRepositoryInterface;

class TransactionFeeRepository implements TransactionFeeRepositoryInterface
{
    public function __construct(
        private TransactionFee $entity
    )
    {
        //
    }

    public function create(TransactionFeeDTO $dto): TransactionFee
    {
        return $this->entity->create([
            'quantity'       => $dto->quantity,
            'credit_card_id' => $dto->creditCardId,
            'transaction_id' => $dto->transactionId,
        ]);
    }
}
