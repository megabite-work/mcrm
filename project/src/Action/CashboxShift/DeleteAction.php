<?php

namespace App\Action\CashboxShift;

use App\Entity\CashboxShift;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $entity = $this->em->find(CashboxShift::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($entity);
        $this->em->flush();

        return true;
    }
}
