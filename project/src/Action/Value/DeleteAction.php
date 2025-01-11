<?php

namespace App\Action\Value;

use App\Entity\ValueEntity;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(ValueEntity::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
