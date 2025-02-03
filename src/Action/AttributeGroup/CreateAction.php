<?php

namespace App\Action\AttributeGroup;

use App\Dto\AttributeGroup\IndexDto;
use App\Dto\AttributeGroup\RequestDto;
use App\Entity\AttributeGroup;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new AttributeGroup())
            ->setName($dto->getName());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
