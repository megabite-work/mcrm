<?php

namespace App\Action\WebFooter;

use App\Entity\WebFooter;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebFooter::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
