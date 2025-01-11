<?php

namespace App\Action\WebBanner;

use App\Entity\WebBanner;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebBanner::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
