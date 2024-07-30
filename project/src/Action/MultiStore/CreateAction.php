<?php

namespace App\Action\MultiStore;

use App\Entity\User;
use App\Entity\MultiStore;
use App\Dto\MultiStore\CreateRequestDto;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(User $user, CreateRequestDto $dto): MultiStore
    {
        $multiStore = (new MultiStore())
            ->setName($dto->getName())
            ->setOwner($user);

        $this->em->persist($multiStore);
        $this->em->flush();

        return $multiStore;
    }
}
