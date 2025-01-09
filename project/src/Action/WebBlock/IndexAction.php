<?php

namespace App\Action\WebBlock;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebBlock\IndexDto;
use App\Dto\WebBlock\RequestQueryDto;
use App\Repository\WebBlockRepository;

class IndexAction
{
    public function __construct(
        private WebBlockRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebBloksByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
