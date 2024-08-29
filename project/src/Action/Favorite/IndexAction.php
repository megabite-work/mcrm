<?php

namespace App\Action\Favorite;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;

class IndexAction
{
    public function __invoke(User $user): Collection
    {
        $favorites = $user->getFavorites();

        return $favorites;
    }
}
