<?php

namespace App\Action\Store;

use App\Dto\Store\IndexDto;
use App\Dto\Store\RequestDto;
use App\Entity\MultiStore;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $multiStore = $this->em->getReference(MultiStore::class, $dto->multiStoreId);

        $entity = (new Store())
            ->setName($dto->name)
            ->setMultiStore($multiStore);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
