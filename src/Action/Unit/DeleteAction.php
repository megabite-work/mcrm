<?php

namespace App\Action\Unit;

use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $unit = $this->em->find(Unit::class, $id);
        $this->em->remove($unit);
        $this->em->flush();
    }
}
