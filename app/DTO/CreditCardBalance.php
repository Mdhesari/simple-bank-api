<?php

namespace App\DTO;

class CreditCardBalance
{
    public function __construct(
        public float  $quantity,
        public string $creditCardId,
    )
    {
        //
    }
}
