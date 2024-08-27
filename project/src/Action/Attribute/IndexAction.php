<?php

namespace App\Action\Attribute;

use App\Component\Paginator;
use App\Dto\Attribute\RequestQueryDto;
use App\Repository\AttributeEntityRepository;

class IndexAction
{
    public function __construct(
        private AttributeEntityRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $entities = $this->repo->findAllAttributesByCategory($dto);

        return $entities;
    }
}
