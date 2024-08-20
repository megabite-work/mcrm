<?php

namespace App\Action\CashboxShift;

use App\Component\Paginator;
use App\Dto\CashboxShift\RequestQueryDto;
use App\Repository\CashboxShiftRepository;

class IndexAction
{
    public function __construct(
        private CashboxShiftRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $cashboxShifts = $this->repo->findAllCashboxShiftsByCashbox($dto);

        return $cashboxShifts;
    }
}
