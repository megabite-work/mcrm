<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreRepository $repo
    ) {
    }

    public function __invoke(int $id): bool
    {
        $store = $this->repo->find($id);

        if (null === $store) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($store);
        $this->em->flush();

        return true;
    }
}
