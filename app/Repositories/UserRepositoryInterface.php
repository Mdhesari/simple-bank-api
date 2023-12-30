<?php

namespace App\Repositories;

use App\DTO\UserTransactionFilterDTO;
use App\Models\User;

interface UserRepositoryInterface
{
    public function findByMobile(string $mobile): ?User;

    public function getRecent(UserTransactionFilterDTO $dto);
}
