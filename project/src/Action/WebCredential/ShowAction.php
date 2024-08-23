<?php

namespace App\Action\WebCredential;

use App\Component\EntityNotFoundException;
use App\Entity\WebCredential;
use App\Repository\MultiStoreRepository;

class ShowAction
{
    public function __construct(private MultiStoreRepository $repo) {}

    public function __invoke(int $multiStoreId): WebCredential
    {
        $entity = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId)->getWebCredential();

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
