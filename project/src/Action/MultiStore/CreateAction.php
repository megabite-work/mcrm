<?php

namespace App\Action\MultiStore;

use App\Dto\MultiStore\RequestDto;
use App\Entity\MultiStore;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(User $user, RequestDto $dto): MultiStore
    {
        $multiStore = (new MultiStore())
            ->setName($dto->getName())
            ->setProfit($dto->getProfit())
            ->setNds($dto->getNds())
            ->setOwner($user);

        $this->em->persist($multiStore);
        $this->em->flush();

        return $multiStore;
    }
}
