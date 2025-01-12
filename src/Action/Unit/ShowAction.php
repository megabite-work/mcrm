<?php

namespace App\Action\Unit;

use App\Dto\Unit\IndexDto;
use App\Repository\UnitRepository;

class ShowAction
{
    public function __construct(
        private UnitRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findUnitById($id));
    }
}
