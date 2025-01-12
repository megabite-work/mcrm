<?php

namespace App\Action\Value;

use App\Dto\Value\IndexDto;
use App\Repository\ValueEntityRepository;

class ShowAction
{
    public function __construct(
        private ValueEntityRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
