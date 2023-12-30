<?php

namespace App\Services;

use App\DTO\UserTransactionFilterDTO;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repo
    )
    {
        //
    }

    public function getRecent(UserTransactionFilterDTO $dto)
    {
        return $this->repo->getRecent($dto);
    }
}
