<?php

namespace App\Action\AttributeGroup;

use App\Dto\AttributeGroup\IndexDto;
use App\Dto\AttributeGroup\RequestQueryDto;
use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Repository\AttributeGroupRepository;

class IndexAction
{
    public function __construct(
        private AttributeGroupRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $isFull = $dto->isFull ?? false;
        $paginator = $this->repo->findAllAttributeGroups($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) use ($isFull) {
            $entity = $isFull ? IndexDto::fromWithFullRelation($entity) : IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
