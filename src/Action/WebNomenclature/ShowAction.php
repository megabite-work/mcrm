<?php

namespace App\Action\WebNomenclature;

use App\Dto\WebNomenclature\IndexDto;
use App\Repository\WebNomenclatureRepository;

class ShowAction
{
    public function __construct(
        private WebNomenclatureRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findWebNomenclatureByIdWithCategoryUnitStoreNomenclature($id));
    }
}
