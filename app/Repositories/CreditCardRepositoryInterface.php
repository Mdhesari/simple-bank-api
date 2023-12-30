<?php

namespace App\Repositories;

interface CreditCardRepositoryInterface
{
    public function getCreditCards(\App\DTO\CreditCardFilterDTO $dto);

    public function hasEnoughBalance(\App\DTO\CreditCardBalance $param): bool;
}
