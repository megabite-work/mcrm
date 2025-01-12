<?php

namespace App\Action\Value;

use App\Dto\Value\IndexDto;
use App\Dto\Value\RequestDto;
use App\Entity\AttributeEntity;
use App\Entity\AttributeValue;
use App\Entity\ValueEntity;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $attribute = $this->em->getReference(AttributeEntity::class, $dto->attributeId);
        $entity = (new ValueEntity())->setName($dto->getName());
        $this->em->persist($entity);
        $this->assign($attribute, $entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function assign(AttributeEntity $attribute, ValueEntity $value): void
    {
        $entity = (new AttributeValue())
            ->setAttribute($attribute)
            ->setValue($value);
        $this->em->persist($entity);
    }
}
