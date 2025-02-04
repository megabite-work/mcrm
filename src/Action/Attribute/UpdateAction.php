<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Dto\Attribute\RequestDto;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(AttributeEntity::class, $id);
        $entity->setName(
            [
                'ru' => $dto->nameRu ?? $entity->getName()['ru'],
                'uz' => $dto->nameUz ?? $entity->getName()['uz'],
                'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
            ]
        )->setUnit(
            [
                'ru' => $dto->unitRu ?? $entity->getUnit()['ru'],
                'uz' => $dto->unitUz ?? $entity->getUnit()['uz'],
                'uzc' => $dto->unitUzc ?? $entity->getUnit()['uzc'],
            ]
        )->setGroupId($dto->groupId ?? $entity->getGroupId());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
