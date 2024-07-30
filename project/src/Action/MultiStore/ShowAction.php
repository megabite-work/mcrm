<?php

namespace App\Action\MultiStore;

use App\Component\EntityNotFoundException;
use App\Entity\MultiStore;
use App\Repository\MultiStoreRepository;

class ShowAction
{
    public function __construct(private MultiStoreRepository $repo)
    {
    }

    public function __invoke(int $id): MultiStore
    {
        $multiStore = $this->repo->find($id);

        if ($multiStore === null) {
            throw new EntityNotFoundException('not found');
        }
        
        return $multiStore;
    }
}
