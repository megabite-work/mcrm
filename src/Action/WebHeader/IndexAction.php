<?php

namespace App\Action\WebHeader;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebHeader\IndexDto;
use App\Dto\WebHeader\RequestQueryDto;
use App\Repository\WebHeaderRepository;

class IndexAction
{
    public function __construct(
        private WebHeaderRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebHeadersByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
