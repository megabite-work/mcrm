<?php

namespace App\Action\WebFooterBody;

use App\Dto\WebFooterBody\IndexDto;
use App\Repository\WebFooterBodyRepository;

class ShowAction
{
    public function __construct(
        private WebFooterBodyRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
