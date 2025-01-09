<?php

namespace App\Action\WebBlock;

use App\Dto\WebBlock\IndexDto;
use App\Repository\WebBlockRepository;

class ShowAction
{
    public function __construct(
        private WebBlockRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
