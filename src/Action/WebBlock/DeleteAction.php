<?php

namespace App\Action\WebBlock;

use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebBlock::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
