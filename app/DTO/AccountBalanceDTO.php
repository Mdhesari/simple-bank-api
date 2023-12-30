<?php

namespace App\DTO;

class AccountBalanceDTO
{
    public function __construct(
        public int    $accountId,
        public float  $quantity,
    )
    {
        //
    }
}
