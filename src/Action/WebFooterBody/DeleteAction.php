<?php

namespace App\Action\WebFooterBody;

use App\Entity\WebFooterBody;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebFooterBody::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
