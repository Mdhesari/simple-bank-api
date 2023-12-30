<?php

namespace App\DTO;

use App\Enums\AccountType;

class AccountDTO
{
    public function __construct(
        public AccountType $type,
        public float       $quantity,
        public int         $userId,
    )
    {
        //
    }
}
