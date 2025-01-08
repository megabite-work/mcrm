<?php

namespace App\Action\Store;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Store\IndexDto;
use App\Dto\Store\RequestQueryDto;
use App\Repository\StoreRepository;

class IndexAction
{
    public function __construct(
        private StoreRepository $storeRepo,
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->storeRepo->findAllStoresByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
