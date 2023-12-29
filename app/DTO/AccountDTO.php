<?php

namespace App\DTO;

use App\Enums\AccountType;

class AccountDTO
{
    public function __construct(
        public AccountType $type,
        public string      $cardNumber,
        public string      $shebaNumber,
        public float       $quantity,
        public int         $userId,
    )
    {
        //
    }
}
