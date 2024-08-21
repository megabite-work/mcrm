<?php

namespace App\Action\CashboxPayment;

use App\Component\EntityNotFoundException;
use App\Entity\CashboxPayment;
use App\Repository\CashboxPaymentRepository;

class ShowAction
{
    public function __construct(private CashboxPaymentRepository $repo)
    {
    }

    public function __invoke(int $id): CashboxPayment
    {
        $entity = $this->repo->findCashboxPaymentById($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
