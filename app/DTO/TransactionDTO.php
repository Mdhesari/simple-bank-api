<?php

namespace App\DTO;

use App\Enums\TransactionStatus;

class TransactionDTO
{
    public function __construct(
        public float             $quantity,
        public TransactionStatus $status,
        public string            $srcCreditCardId,
        public string            $dstCreditCardId,
    )
    {
        //
    }
}
