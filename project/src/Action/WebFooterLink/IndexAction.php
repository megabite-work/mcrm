<?php

namespace App\Action\WebFooterLink;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebFooterLink\IndexDto;
use App\Dto\WebFooterLink\RequestQueryDto;
use App\Repository\WebFooterLinkRepository;

class IndexAction
{
    public function __construct(
        private WebFooterLinkRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebFooterLinksByWebFooterBody($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
