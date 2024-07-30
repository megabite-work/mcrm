<?php

namespace App\Action\Store;

use App\Component\EntityNotFoundException;
use App\Dto\Store\UpdateRequestDto;
use App\Entity\Store;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreRepository $repo
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
        if ($dto->getIsActive() !== null) {
            $store->setIsActive($dto->getIsActive());
        }
        if ($dto->getCoordinate()) {
            $store->setCoordinate($dto->getCoordinate());
        }
        if ($dto->getOfficialAddress()) {
            $store->setOgetOfficialAddress($dto->getOfficialAddress());
        }

        $this->em->flush();

        return $store;
    }
}
