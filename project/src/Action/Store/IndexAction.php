<?php

namespace App\Action\Store;

use App\Entity\MultiStore;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private StoreRepository $repo,
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $multiStoreId): array
    {
        $multiStore = $this->em->getRepository(MultiStore::class)->getMultiStoreById($multiStoreId);

        $stores = $this->repo->findAllStoresByMultiStore($multiStore);

        return $stores;
    }
}
