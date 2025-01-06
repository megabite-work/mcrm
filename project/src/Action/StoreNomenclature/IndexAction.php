<?php

namespace App\Action\StoreNomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\StoreNomenclature\IndexDto;
use App\Dto\StoreNomenclature\RequestQueryDto;
use App\Repository\StoreNomenclatureRepository;

class IndexAction
{
    public function __construct(
        private StoreNomenclatureRepository $repo
    ) {}

    public function __invoke(int $storeId, RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllNomenclaturesWithStoreAndCategory($storeId, $dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromStore($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
