<?php

namespace App\DTO;

class CreditCardFilterDTO
{
    public function __construct(
        public ?string $number = null,
        public ?string $accountId = null,
        public ?string $sheba = null,
        public int     $perPage = 10,
    )
    {
        //
    }
}
