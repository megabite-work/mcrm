<?php

namespace App\Action\CashboxGlobal;

use App\Component\EntityNotFoundException;
use App\Entity\CashboxGlobal;
use App\Repository\CashboxGlobalRepository;

class ShowAction
{
    public function __construct(private CashboxGlobalRepository $repo)
    {
    }

    public function __invoke(int $id): CashboxGlobal
    {
        $entity = $this->repo->findCashboxGlobalById($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
