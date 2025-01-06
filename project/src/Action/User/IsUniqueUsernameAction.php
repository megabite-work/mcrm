<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IsUniqueUsernameAction
{
    public function __construct(
        private UserRepository $repo
<<<<<<< HEAD
    ) {}
=======
    ) {
    }
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)

    public function __invoke(string $username): bool
    {
        return $this->repo->isUniqueUsername($username);
    }
}
