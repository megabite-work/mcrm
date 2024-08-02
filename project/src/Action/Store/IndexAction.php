<?php

namespace App\Action\Store;

use App\Component\Paginator;
use App\Dto\Store\RequestQueryDto;
use App\Repository\StoreRepository;
use App\Repository\MultiStoreRepository;

class IndexAction
{
    public function __construct(
        private StoreRepository $storeRepo,
        private MultiStoreRepository $multiStoreRepo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $multiStore = $this->multiStoreRepo->find($dto->getMultiStoreId());

        $stores = $this->storeRepo->findAllStoresByMultiStore($multiStore, $dto);

        return $stores;
    }
}
