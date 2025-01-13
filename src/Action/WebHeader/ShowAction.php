<?php

namespace App\Action\WebHeader;

use App\Dto\WebHeader\IndexDto;
use App\Repository\WebHeaderRepository;

class ShowAction
{
    public function __construct(
        private WebHeaderRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
