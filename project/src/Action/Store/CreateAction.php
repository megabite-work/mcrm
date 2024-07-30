<?php

namespace App\Action\Store;

use App\Entity\Store;
use App\Dto\Store\CreateRequestDto;
use App\Entity\MultiStore;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(CreateRequestDto $dto): Store
    {
        $multiStore = $this->em->getRepository(MultiStore::class)->getMultiStoreById($dto->getMultiStoreId());

        $store = (new Store())
            ->setName($dto->getName())
            ->setMultiStore($multiStore);

        $this->em->persist($store);
        $this->em->flush();

        return $store;
    }
}
