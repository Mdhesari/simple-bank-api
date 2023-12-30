<?php

namespace App\DTO;

class TransactionFeeDTO
{
    public function __construct(
        public float $quantity,
        public int   $creditCardId,
        public int   $transactionId,
    )
    {
        //
    }
}
