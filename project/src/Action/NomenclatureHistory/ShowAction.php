<?php

namespace App\Action\NomenclatureHistory;

use App\Dto\NomenclatureHistory\IndexDto;
use App\Repository\NomenclatureHistoryRepository;

class ShowAction
{
    public function __construct(
        private NomenclatureHistoryRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findNomenclatureHistoryById($id));
    }
}
