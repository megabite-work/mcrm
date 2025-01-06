<?php

namespace App\Action\Store;

<<<<<<< HEAD
use App\Dto\Store\IndexDto;
=======
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
use App\Dto\Store\RequestDto;
use App\Entity\MultiStore;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
<<<<<<< HEAD
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
=======
    ) {
    }

    public function __invoke(RequestDto $dto): Store
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        $store = (new Store())
            ->setName($dto->getName())
            ->setMultiStore($multiStore);

        $this->em->persist($store);
        $this->em->flush();

        return $store;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
