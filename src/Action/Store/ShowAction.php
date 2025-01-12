<?php

namespace App\Action\Store;

use App\Dto\Store\IndexDto;
use App\Repository\StoreRepository;

class ShowAction
{
    public function __construct(
        private StoreRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findStoreByIdWithAddressAndPhonesAndWorkers($id), true);
    }
}
