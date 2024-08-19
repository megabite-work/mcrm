<?php

namespace App\Action\CashboxShift;

use App\Component\EntityNotFoundException;
use App\Entity\CashboxShift;
use App\Repository\CashboxShiftRepository;

class ShowAction
{
    public function __construct(private CashboxShiftRepository $repo)
    {
    }

    public function __invoke(int $id): CashboxShift
    {
        $cashboxShift = $this->repo->findCashboxShiftById($id);

        if (null === $cashboxShift) {
            throw new EntityNotFoundException('not found');
        }

        return $cashboxShift;
    }
}
