<?php

namespace App\Action\WebEvent;

use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebEvent::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
