<?php

namespace App\Repositories;

use App\DTO\TransactionDTO;
use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function deposit(TransactionDTO $dto): Transaction;
}
