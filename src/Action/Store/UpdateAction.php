<?php

namespace App\Action\Store;

use App\Dto\Store\IndexDto;
use App\Dto\Store\RequestDto;
use App\Repository\AddressRepository;
use App\Repository\PhoneRepository;
use App\Repository\StoreRepository;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private PhoneRepository $phoneRepository,
        private AddressRepository $addressRepository,
        private StoreRepository $storeRepository,
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->storeRepository->findStoreByIdWithAddressAndPhones($id);
        $entity->setName($dto->name ?? $entity->getName())
            ->setIsActive($dto->isActive);

        $this->phoneRepository->checkPhoneExistsAndCreate($entity, $dto->phones);
        $this->addressRepository->checkAddressExistsAndUpdateOrCreate($entity, $dto);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
