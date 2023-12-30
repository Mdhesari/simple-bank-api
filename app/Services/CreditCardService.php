<?php

namespace App\Services;

use App\DTO\CreditCardFilterDTO;
use App\Repositories\CreditCardRepositoryInterface;

class CreditCardService
{
    public function __construct(
        private CreditCardRepositoryInterface $creditCardRepo,
    )
    {
        //
    }

    public function getCreditCards(CreditCardFilterDTO $dto)
    {
        return $this->creditCardRepo->getCreditCards($dto);
    }
}
