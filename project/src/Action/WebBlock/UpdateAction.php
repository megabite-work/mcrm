<?php

namespace App\Action\WebBlock;

use App\Dto\WebBlock\IndexDto;
use App\Dto\WebBlock\RequestDto;
use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebBlock::class, $id);
        $entity->setType($dto->type ?? $entity->getType())
            ->setTypeId($dto->typeId ?? $entity->getTypeId())
            ->setIsActive($dto->isActive ?? $entity->getIsActive())
            ->setTitle($dto->title ?? $entity->getTitle());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
