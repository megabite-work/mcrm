<?php

namespace App\Action\CashboxShift;

use App\Component\EntityNotFoundException;
use App\Entity\CashboxShift;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): CashboxShift
    {
        $cashboxShift = $this->em->find(CashboxShift::class, $id);

        if (null === $cashboxShift) {
            throw new EntityNotFoundException('not found');
        }

        $cashboxShift->setClosedAt(date_create());

        $this->em->flush();

        return $cashboxShift;
    }
}
