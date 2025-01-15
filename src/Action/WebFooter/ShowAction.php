<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooter\IndexDto;
use App\Repository\WebFooterRepository;

class ShowAction
{
    public function __construct(
        private WebFooterRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        dd($this->repo->findWebFooterWithRelation($id));
        return IndexDto::fromEntity($this->repo->findWebFooterWithRelation($id));
    }
}
