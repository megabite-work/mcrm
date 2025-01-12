<?php

namespace App\Action\WebFooterLink;

use App\Dto\WebFooterLink\IndexDto;
use App\Repository\WebFooterLinkRepository;

class ShowAction
{
    public function __construct(
        private WebFooterLinkRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
