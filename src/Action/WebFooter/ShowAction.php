<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooterLink\IndexDto as WebFooterLinkIndexDto;
use App\Dto\WebFooter\IndexDto;
use App\Entity\WebFooterLink;
use App\Repository\WebFooterRepository;

class ShowAction
{
    public function __construct(
        private WebFooterRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $result = $this->repo->findWebFooterWithRelation($id);
        $links = array_map(function ($item) {
            return $item instanceof WebFooterLink ? WebFooterLinkIndexDto::fromEntity($item) : null;
        }, $result);
        
        return IndexDto::fromEntityWithRelation($result[0], $links);
    }
}
