<?php

namespace App\Action\Value;

use App\Dto\Value\IndexDto;
use App\Dto\Value\RequestDto;
use App\Entity\ValueEntity;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->getReference(ValueEntity::class, $id);
        $entity->setName([
            'ru' => $dto->nameRu ?? $entity->getName()['ru'],
            'uz' => $dto->nameUz ?? $entity->getName()['uz'],
            'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
        ]);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
