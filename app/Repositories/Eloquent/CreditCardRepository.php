<?php

namespace App\Repositories\Eloquent;

use App\DTO\CreditCardBalance;
use App\DTO\CreditCardFilterDTO;
use App\Models\CreditCard;
use App\Repositories\CreditCardRepositoryInterface;

class CreditCardRepository implements CreditCardRepositoryInterface
{
    public function __construct(
        private CreditCard $entity
    )
    {
        //
    }


    public function getCreditCards(CreditCardFilterDTO $dto): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = $this->entity->newQuery();

        if ($dto->accountId) {
            $query->where('accountId', $dto->accountId);
        }

        if ($dto->number) {
            $query->where('card_number', $dto->number);
        }

        if ($dto->sheba) {
            $query->where('sheba', $dto->sheba);
        }

        return $query->paginate($dto->perPage);
    }

    public function hasEnoughBalance(CreditCardBalance $dto): bool
    {
        $e = $this->entity->find($dto->creditCardId);

        return $e->getTotalBalance() >= $dto->quantity;
    }
}
