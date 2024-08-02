<?php

namespace App\Action\Store;

use App\Entity\Phone;
use App\Entity\Store;
use App\Entity\Address;
use App\Dto\Store\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Store
    {
        $store = $this->updateStore($id, $dto);

        $this->em->getRepository(Phone::class)->checkPhoneExistsAndCreate($store, $dto->getPhones());
        $this->em->getRepository(Address::class)->checkAddressExistsAndUpdateOrCreate($store, $dto);
        $this->em->flush();

        return $store;
    }

    private function updateStore(int $id, RequestDto $dto)
    {
        $store = $this->em->getRepository(Store::class)->findStoreByIdWithAddressAndPhones($id);

        if (null === $store) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getName()) {
            $store->setName($dto->getName());
        }
        if (null !== $dto->getIsActive()) {
            $store->setIsActive($dto->getIsActive());
        }

        return $store;
    }
}
