<?php

namespace App\Action\Unit;

use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): Unit
    {
        $unit = (new Unit())
            ->setName($dto->getName())
            ->setCode($dto->getCode())
            ->setIcon($dto->getIcon());

        $this->em->persist($unit);
        $this->em->flush();

        return $unit;
    }
}
