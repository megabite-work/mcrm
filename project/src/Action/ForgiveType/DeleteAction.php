<?php

namespace App\Action\ForgiveType;

use App\Component\EntityNotFoundException;
use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $forgiveType = $this->em->find(ForgiveType::class, $id);

        if (null === $forgiveType) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($forgiveType);
        $this->em->flush();

        return true;
    }
}
