<?php

namespace App\Action\Favorite;

use App\Component\Paginator;
use App\Repository\UserRepository;
use App\Repository\WebNomenclatureRepository;

class IndexAction
{
    public function __construct(
        private WebNomenclatureRepository $webNomenclatureRepository,
        private UserRepository $userRepository
    ) {}

    public function __invoke(int $id): Paginator
    {
        $favoriteIds = $this->userRepository->findAllUserFavoriteIds($id);
        $favorites = $this->webNomenclatureRepository->findAllUserFavoritesByIds($favoriteIds);

        return $favorites;
    }
}
