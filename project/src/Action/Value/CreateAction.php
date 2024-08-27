<?php

namespace App\Action\Value;

use App\Entity\ValueEntity;
use App\Dto\Value\RequestDto;
use App\Entity\AttributeValue;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): ValueEntity
    {
        $attribute = $this->em->find(AttributeEntity::class, $dto->getAttributeId());

        if (null === $attribute) {
            throw new EntityNotFoundException('attribute not found');
        }

        $entity = $this->create($dto, $attribute);


        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto, AttributeEntity $attribute): ValueEntity
    {
        $entity = (new ValueEntity())
            ->setName($dto->getName());

        $this->em->persist($entity);
        $this->assign($attribute, $entity);
        
        return $entity;
    }

    private function assign(AttributeEntity $attribute, ValueEntity $value): void
    {
        $entity = (new AttributeValue())
            ->setAttribute($attribute)
            ->setValue($value);

        $this->em->persist($entity);
    }
}
