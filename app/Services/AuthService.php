<?php

namespace App\Services;

use App\DTO\CredentialDTO;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Hashing\HashManager;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        private UserRepositoryInterface $userRepo,
        private HashManager             $hashManager,
    )
    {
        //
    }

    /**
     *
     * Will handle validation exceptions in Handler.php
     * @throws ValidationException
     */
    public function createToken(CredentialDTO $dto): string
    {
        $user = $this->userRepo->findByMobile($dto->mobile);
        if (! $user) {

            throw $this->getAuthFailureException();
        }

        if (! $this->hashManager->check($dto->password, $user->password)) {

            throw $this->getAuthFailureException();
        }

        return $user->createToken(User::DEFAULT_TOKEN_NAME)->plainTextToken;
    }

    private function getAuthFailureException()
    {
        return ValidationException::withMessages([
            'mobile' => __('auth.failed')
        ]);
    }
}
