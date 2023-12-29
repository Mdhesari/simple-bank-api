<?php

namespace App\Repositories;

use App\DTO\TransactionFeeDTO;
use App\Models\TransactionFee;

interface TransactionFeeRepositoryInterface
{
    public function create(TransactionFeeDTO $dto): TransactionFee;
}
