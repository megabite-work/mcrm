<?php

namespace App\Action\WebEvent;

use App\Dto\WebEvent\IndexDto;
use App\Dto\WebEvent\RequestDto;
use App\Entity\WebEvent;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $entity = (new WebEvent())
            ->setMultiStoreId($dto->multiStoreId)
            ->setType($dto->type)
            ->setTypeIds($dto->typeIds)
            ->setTitle($dto->title)
            ->setDelay($dto->delay)
            ->setMove($dto->move)
            ->setAnimation($dto->animation);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
