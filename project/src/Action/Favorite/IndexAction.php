<?php

namespace App\Action\Favorite;

use App\Component\Paginator;
use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(private UserRepository $repo) {}

    public function __invoke(int $id): Paginator
    {
        $favorites = $this->repo->findAllUserFavorites($id);

        return $favorites;
    }
}
