<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Entity\Store;
use App\Repository\StoreRepository;

class ShowAction
{
    public function __construct(private StoreRepository $repo)
    {
    }

    public function __invoke(int $id): Store
    {
        $store = $this->repo->find($id);

        if ($store === null) {
            throw new EntityNotFoundException('not found');
        }
        
        return $store;
    }
}