<?php

namespace App\Action\AttributeGroup;

use App\Dto\AttributeGroup\IndexDto;
use App\Dto\AttributeGroup\RequestDto;
use App\Entity\AttributeGroup;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(AttributeGroup::class, $id);
        $entity->setName([
            'ru' => $dto->nameRu ?? $entity->getName()['ru'],
            'uz' => $dto->nameUz ?? $entity->getName()['uz'],
            'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
        ]);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
