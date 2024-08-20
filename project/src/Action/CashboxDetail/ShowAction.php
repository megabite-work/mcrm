<?php

namespace App\Action\CashboxDetail;

use App\Component\EntityNotFoundException;
use App\Entity\CashboxDetail;
use App\Repository\CashboxDetailRepository;

class ShowAction
{
    public function __construct(private CashboxDetailRepository $repo)
    {
    }

    public function __invoke(int $id): CashboxDetail
    {
        $entity = $this->repo->findCashboxDetailByIdWithJoined($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
