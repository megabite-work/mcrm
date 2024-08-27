<?php

namespace App\Action\Attribute;

use App\Component\EntityNotFoundException;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $entity = $this->em->find(AttributeEntity::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }
}
