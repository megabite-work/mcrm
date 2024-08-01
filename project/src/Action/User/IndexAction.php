<?php

namespace App\Action\User;

use App\Component\Paginator;
use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(private UserRepository $repo)
    {
    }

    public function __invoke(int $page): Paginator
    {
        $users = $this->repo->findAllWithPagination($page);

        return $users;
    }
}
