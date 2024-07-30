<?php

namespace App\Action\User;

use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(): array
    {
        $users = $this->repo->findAll();
        return $users;
    }
}
