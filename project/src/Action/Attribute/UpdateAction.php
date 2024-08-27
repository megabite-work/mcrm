<?php

namespace App\Action\Attribute;

use App\Component\EntityNotFoundException;
use App\Dto\Attribute\RequestDto;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): AttributeEntity
    {
        $entity = $this->em->find(AttributeEntity::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($dto, $entity);

        $this->em->flush();

        return $entity;
    }

    private function update(RequestDto $dto, AttributeEntity $entity): AttributeEntity
    {
        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $attributeName = $entity->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $attributeName['ru'],
                'uz' => $dto->getNameUz() ?? $attributeName['uz'],
                'uzc' => $dto->getNameUzc() ?? $attributeName['uzc'],
            ];

            $entity->setName($name);
        }


        return $entity;
    }
}
