<?php

namespace App\Action\NomenclatureHistory;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\NomenclatureHistory\IndexDto;
use App\Dto\NomenclatureHistory\RequestQueryDto;
use App\Repository\NomenclatureHistoryRepository;

class IndexAction
{
    public function __construct(
        private NomenclatureHistoryRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllNomenclatureHistoriesWithAllJoines($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
