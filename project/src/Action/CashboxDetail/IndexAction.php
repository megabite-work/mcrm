<?php

namespace App\Action\CashboxDetail;

use App\Component\Paginator;
use App\Dto\CashboxDetail\RequestQueryDto;
use App\Repository\CashboxDetailRepository;

class IndexAction
{
    public function __construct(
        private CashboxDetailRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $entities = $this->repo->findAllCashboxDetailsByCashbox($dto);

        return $entities;
    }
}
