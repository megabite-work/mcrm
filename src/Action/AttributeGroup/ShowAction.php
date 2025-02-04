<?php

namespace App\Action\AttributeGroup;

use App\Dto\AttributeGroup\IndexDto;
use App\Repository\AttributeGroupRepository;

class ShowAction
{
    public function __construct(
        private AttributeGroupRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
