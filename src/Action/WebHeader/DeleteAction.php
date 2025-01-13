<?php

namespace App\Action\WebHeader;

use App\Entity\WebHeader;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebHeader::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
