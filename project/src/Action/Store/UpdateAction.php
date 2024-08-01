<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Dto\Store\UpdateRequestDto;
use App\Entity\Store;
use App\Repository\AddressRepository;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreRepository $repo,
        private AddressRepository $addressRepo
    ) {
    }

    public function __invoke(int $id, UpdateRequestDto $dto): Store
    {
        $store = $this->repo->find($id);

        if (null === $store) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getName()) {
            $store->setName($dto->getName());
        }
        if (null !== $dto->getIsActive()) {
            $store->setIsActive($dto->getIsActive());
        }

        $this->addressRepo->checkAddressExistsAndUpdateOrCreate($store, $dto);

        $this->em->flush();

        return $store;
    }
}
