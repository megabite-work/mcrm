<?php

namespace App\Action\WebFooter;

use App\Dto\WebFooterBody\IndexDto as WebFooterBodyIndexDto;
use App\Dto\WebFooterLink\IndexDto as WebFooterLinkIndexDto;
use App\Dto\WebFooter\IndexDto;
use App\Entity\WebFooterBody;
use App\Entity\WebFooterLink;
use App\Repository\WebFooterRepository;

class ShowAction
{
    public function __construct(
        private WebFooterRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $bodies = [];
        $links = [];
        $result = $this->repo->findWebFooterWithRelation($id);
        $entity = $result[0];

        foreach ($result as $item) {
            if ($item instanceof WebFooterBody) {
                $bodies[] = WebFooterBodyIndexDto::fromEntity($item);
            } else if ($item instanceof WebFooterLink) {
                $links[] = WebFooterLinkIndexDto::fromEntity($item);
            }
        }
        return IndexDto::fromEntityWithRelation($entity, $bodies, $links);
    }
}
