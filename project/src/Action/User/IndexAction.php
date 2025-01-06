<?php

namespace App\Action\User;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\User\IndexDto;
use App\Dto\User\RequestQueryDto;
use App\Repository\UserRepository;

class IndexAction
{
    public function __construct(
        private UserRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findUsersWithPagination($dto);
        $data = $paginator->getData();

        array_walk($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
