<?php

namespace App\Action\ForgiveType;

use App\Component\Paginator;
use App\Dto\ForgiveType\RequestQueryDto;
use App\Repository\ForgiveTypeRepository;

class IndexAction
{
    public function __construct(
        private ForgiveTypeRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $forgiveTypes = $this->repo->findAllForgiveTypes($dto);

        return $forgiveTypes;
    }
}
