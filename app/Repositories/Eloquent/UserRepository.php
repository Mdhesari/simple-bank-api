<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

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
}
