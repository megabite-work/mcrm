<?php

namespace App\Action\Store;

use App\Repository\MultiStoreRepository;
use App\Repository\StoreRepository;

class IndexAction
{
    public function __construct(
        private StoreRepository $repo,
        private MultiStoreRepository $multiStoreRepo
    ) {
    }

    public function __invoke(int $multiStoreId): array
    {
        $multiStore = $this->multiStoreRepo->getMultiStoreById($multiStoreId);

        $stores = $this->repo->findAllStoresByMultiStore($multiStore);

        return $stores;
    }
}
