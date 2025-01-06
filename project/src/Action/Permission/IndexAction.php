<?php

namespace App\Action\Permission;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Permission\IndexDto;
use App\Dto\Permission\RequestQueryDto;
use App\Repository\PermissionRepository;

class IndexAction
{
    public function __construct(
        private PermissionRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllPermissions($dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
