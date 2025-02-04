<?php

namespace App\Action\AttributeGroup;

use App\Dto\AttributeGroup\IndexDto;
use App\Dto\AttributeGroup\RequestDto;
use App\Entity\AttributeGroup;
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
            throw new ErrorException('Attribute Group', $th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(RequestDto $dto): IndexDto
    {
        $entity = (new AttributeGroup())
            ->setName($dto->getName());
        $this->em->persist($entity);

        return IndexDto::fromEntity($entity);
    }
}
