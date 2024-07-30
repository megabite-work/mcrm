<?php

namespace App\Action\MultiStore;

use App\Component\EntityNotFoundException;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $repo
    ) {
    }

    public function __invoke(int $id): bool
    {
        $multiStore = $this->repo->find($id);

        if (null === $multiStore) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($multiStore);
        $this->em->flush();

        return true;
    }
}
