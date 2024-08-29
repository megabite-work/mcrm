<?php

namespace App\Action\Favorite;

use App\Component\EntityNotFoundException;
use App\Entity\User;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $webNomenclatureId, User $user): bool
    {
        $webNomenclature = $this->em->find(WebNomenclature::class, $webNomenclatureId);

        if (null === $webNomenclature) {
            throw new EntityNotFoundException('webNomenclature not found');
        }
        try {
            $user->addFavorite($webNomenclature);
            $this->em->flush();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
