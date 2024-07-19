<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(private UserRepository $userRepo)
    {
    }

    public function __invoke(): array
    {
        $users = $this->userRepo->findAll();
        return $users;
    }
}
