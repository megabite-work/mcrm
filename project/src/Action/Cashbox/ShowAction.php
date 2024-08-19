<?php

namespace App\Action\Cashbox;

use App\Component\EntityNotFoundException;
use App\Entity\Cashbox;
use App\Repository\CashboxRepository;

class ShowAction
{
    public function __construct(private CashboxRepository $repo)
    {
    }

    public function __invoke(int $id): Cashbox
    {
        $cashbox = $this->repo->findCashboxById($id);

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found');
        }

        return $cashbox;
    }
}
