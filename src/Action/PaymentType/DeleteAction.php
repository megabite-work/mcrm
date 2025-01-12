<?php

namespace App\Action\PaymentType;

use App\Entity\PaymentType;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(PaymentType::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
