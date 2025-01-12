<?php

namespace App\Action\Permission;

use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(Permission::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
