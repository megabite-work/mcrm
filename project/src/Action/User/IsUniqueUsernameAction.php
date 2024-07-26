<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IsUniqueUsernameAction
{
    public function __construct(
        private UserRepository $userRepo
    ) {
    }

    public function __invoke(string $username): bool
    {
        return $this->userRepo->isUniqueUsername($username);
    }
}
