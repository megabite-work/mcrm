<?php

namespace App\Action\Store;

use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $store = $this->em->find(Store::class, $id);
        $this->em->remove($store);
        $this->em->flush();
    }
}
