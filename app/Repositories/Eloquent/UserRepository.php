<?php

namespace App\Repositories\Eloquent;

use App\DTO\UserTransactionFilterDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $entity
    )
    {
        //
    }

    public function findByMobile(string $mobile): ?User
    {
        return $this->entity->mobile($mobile)->first();
    }

    public function getRecent(UserTransactionFilterDTO $dto): \Illuminate\Database\Eloquent\Collection|array
    {
        $datetime = $dto->datetime;
        $count = $dto->count;

        $query = $this->entity->newQuery();

        $users = $query->join('accounts', 'accounts.user_id', '=', 'users.id')
            ->join('credit_cards', 'credit_cards.account_id', '=', 'accounts.id')
            ->join('transactions', 'transactions.src_credit_card_id', '=', 'credit_cards.id')
            ->where('transactions.created_at', '>=', $datetime)
            ->groupBy('users.id')
            ->orderByDesc(DB::raw('SUM(transactions.quantity)'))
            ->limit($dto->limit)
            ->pluck('users.id');

        return User::with([
            'creditCards.withdraws' => function ($query) use ($count) {
                $query->latest()->limit($count);
            },
        ])->whereIn('id', $users)->get();
    }
}
