<?php

namespace App\Action\Unit;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Unit\IndexDto;
use App\Dto\Unit\RequestQueryDto;
use App\Repository\UnitRepository;

class IndexAction
{
    public function __construct(
        private UnitRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllUnits($dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
