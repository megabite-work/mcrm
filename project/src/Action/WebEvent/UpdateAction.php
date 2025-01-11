<?php

namespace App\Action\WebEvent;

use App\Dto\WebEvent\IndexDto;
use App\Dto\WebEvent\RequestDto;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebEvent::class, $id);
        $entity->setType($dto->type ?? $entity->getType())
            ->setTypeIds($dto->typeIds ?? $entity->getTypeIds())
            ->setTitle($dto->title ?? $entity->getTitle())
            ->setDelay($dto->delay ?? $entity->getDelay())
            ->setMove($dto->move ?? $entity->getMove())
            ->setAnimation($dto->animation ?? $entity->getAnimation());
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
