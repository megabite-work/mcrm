<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\IndexDto;
use App\Dto\Attribute\RequestDto;
use App\Entity\AttributeEntity;
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
            throw new ErrorException('Nomenclature', $th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(RequestDto $dto): IndexDto
    {
        $entity = (new AttributeEntity())
            ->setName($dto->getName())
            ->setGroupId($dto->groupId)
            ->setUnit($dto->getUnit());
        $this->em->persist($entity);

        return IndexDto::fromEntity($entity);
    }
}
