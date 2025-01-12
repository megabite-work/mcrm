<?php

namespace App\Action\WebFooterLink;

use App\Entity\WebFooterLink;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebFooterLink::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
