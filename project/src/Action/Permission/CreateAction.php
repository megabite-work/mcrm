<?php

namespace App\Action\Permission;

use App\Dto\Permission\IndexDto;
use App\Dto\Permission\RequestDto;
use App\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = $this->create($dto);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function create(RequestDto $dto): Permission
    {
        $entity = $this->em->getRepository(Permission::class)->findOneBy(
            [
                'resource' => $dto->resource,
                'action' => $dto->action,
            ]
        );

        if ($entity) {
            return $entity;
        }

        $entity = (new Permission())
            ->setName($dto->getName())
            ->setResource($dto->resource)
            ->setAction($dto->action)
            ->setIcon($dto->icon);

        $this->em->persist($entity);

        return $entity;
    }
}
