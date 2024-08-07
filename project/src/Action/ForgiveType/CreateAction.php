<?php

namespace App\Action\ForgiveType;

use App\Dto\ForgiveType\RequestDto;
use App\Entity\ForgiveType;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): ForgiveType
    {
        $forgiveType = (new ForgiveType())
            ->setName($dto->getName());

        $this->em->persist($forgiveType);
        $this->em->flush();

        return $forgiveType;
    }
}
