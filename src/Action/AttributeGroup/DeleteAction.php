<?php

namespace App\Action\AttributeGroup;

use App\Entity\AttributeGroup;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(AttributeGroup::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
