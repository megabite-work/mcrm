<?php

namespace App\Action\Value;

use App\Dto\Value\IndexDto;
use App\Dto\Value\RequestDto;
use App\Entity\AttributeEntity;
use App\Entity\AttributeValue;
use App\Entity\ValueEntity;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(array $dtos): array
    {
        try {
            $this->em->beginTransaction();
            $entities = array_map(fn($dto): IndexDto => $this->create($dto), $dtos);
            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new ErrorException('Attribute Value', $th->getMessage());
        }

        return $entities;
    }

    public function create(RequestDto $dto): IndexDto
    {
        $attribute = $this->em->getReference(AttributeEntity::class, $dto->attributeId);
        $entity = (new ValueEntity())->setName($dto->getName());
        $this->em->persist($entity);
        $this->assign($attribute, $entity);

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
