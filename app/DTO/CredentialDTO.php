<?php

namespace App\DTO;

class CredentialDTO
{
    public function __construct(
        public string $mobile,
        public string $password,
    )
    {
        //
    }
}
