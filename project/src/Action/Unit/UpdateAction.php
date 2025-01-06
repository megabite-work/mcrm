<?php

namespace App\Action\Unit;

use App\Dto\Unit\IndexDto;
use App\Dto\Unit\RequestDto;
use App\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(Unit::class, $id);
        $entity->setName([
            'ru' => $dto->nameRu ?? $entity->getName()['ru'],
            'uz' => $dto->nameUz ?? $entity->getName()['uz'],
            'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
        ])
            ->setIcon($dto->icon);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
