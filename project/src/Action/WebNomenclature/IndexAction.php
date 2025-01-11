<?php

namespace App\Action\WebNomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebNomenclature\IndexDto;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Repository\WebNomenclatureRepository;

class IndexAction
{
    public function __construct(
        private WebNomenclatureRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebNomenclaturesByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
