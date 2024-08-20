<?php

namespace App\Action\CounterPart;

use App\Component\Paginator;
use App\Dto\CounterPart\RequestQueryDto;
use App\Repository\CounterPartRepository;

class IndexAction
{
    public function __construct(
        private CounterPartRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $counterParts = $this->repo->findAllCounterPartsByMultiStore($dto);

        return $counterParts;
    }
}
