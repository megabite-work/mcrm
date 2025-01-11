<?php

namespace App\Action\WebCredential;

use App\Dto\WebCredential\IndexDto;
use App\Repository\MultiStoreRepository;

class ShowAction
{
    public function __construct(
        private MultiStoreRepository $repo
    ) {}

    public function __invoke(int $multiStoreId): IndexDto
    {
        $multiStore = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId);

        return IndexDto::fromEntity($multiStore->getWebCredential());
    }
}
