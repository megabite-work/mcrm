<?php

namespace App\Action\StoreNomenclature;

use App\Dto\StoreNomenclature\IndexDto;
use App\Repository\StoreNomenclatureRepository;

class ShowAction
{
    public function __construct(
        private StoreNomenclatureRepository $repo
    ) {}

    public function __invoke(int $storeId, int $nomenclatureId): IndexDto
    {
        return IndexDto::fromStore($this->repo->findNomenclatureByIdWithStore($storeId, $nomenclatureId));
    }
}
