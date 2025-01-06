<?php

namespace App\Action\Permission;

use App\Dto\Permission\IndexDto;
use App\Dto\Permission\RequestDto;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(Permission::class, $id);
        $entity->setName(
            [
                'ru' => $dto->nameRu ?? $entity->getName()['ru'],
                'uz' => $dto->nameUz ?? $entity->getName()['uz'],
                'uzc' => $dto->nameUzc ?? $entity->getName()['uzc'],
            ]
        )
            ->setIcon($dto->icon ?? $entity->getIcon())
            ->setResource($dto->resource ?? $entity->getResource())
            ->setAction($dto->action ?? $entity->getAction());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
