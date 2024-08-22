<?php

namespace App\Action\Cashbox;

use App\Component\EntityNotFoundException;
use App\Entity\Cashbox;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $cashbox = $this->em->find(Cashbox::class, $id);

        if (null === $cashbox) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($cashbox);
        $this->em->flush();

        return true;
    }
}
