<?php

namespace App\Action\Cashbox;

use App\Component\Paginator;
use App\Dto\Cashbox\RequestQueryDto;
use App\Repository\CashboxRepository;

class IndexAction
{
    public function __construct(
        private CashboxRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $cashboxes = $this->repo->findAllCashboxesByStore($dto);

        return $cashboxes;
    }
}
