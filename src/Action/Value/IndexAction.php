<?php

namespace App\Action\Value;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Value\IndexDto;
use App\Dto\Value\RequestQueryDto;
use App\Repository\ValueEntityRepository;

class IndexAction
{
    public function __construct(
        private ValueEntityRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllValuesByAttribute($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
