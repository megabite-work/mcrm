<?php

namespace App\Action\Store;

use App\Dto\Store\CreateRequestDto;
use App\Entity\Store;
use App\Repository\MultiStoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private MultiStoreRepository $multiStoreRepo
    ) {
    }

    public function __invoke(CreateRequestDto $dto): Store
    {
        $multiStore = $this->multiStoreRepo->getMultiStoreById($dto->getMultiStoreId());

        $store = (new Store())
            ->setName($dto->getName())
            ->setMultiStore($multiStore);

        $this->em->persist($store);
        $this->em->flush();

        return $store;
    }
}
