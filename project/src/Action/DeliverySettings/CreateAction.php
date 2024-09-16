<?php

namespace App\Action\DeliverySettings;

use App\Entity\DeliverySettings;
use App\Dto\DeliverySettings\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RegionRepository;
use App\Repository\StoreRepository;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private StoreRepository $storeRepository,
        private RegionRepository $regionRepository
    ) {}

    public function __invoke(array $dtos): array
    {
        $entities = [];
        foreach ($dtos as $dto) {
            $entity = $this->create($dto);

            $entities[] = $entity;
        }

        $this->em->flush();

        return $entities;
    }

    private function create(RequestDto $dto): DeliverySettings
    {
        $store = $this->storeRepository->find(['id' => $dto->getStoreId()]);
        $region = $this->regionRepository->find(['id' => $dto->getRegionid()]);

        $entity = (new DeliverySettings())
            ->setDeliveryType($dto->getDeliveryType())
            ->setMinSum($dto->getMinSum())
            ->setFirstKm($dto->getFirstKm())
            ->setDeliverySum($dto->getDeliverySum())
            ->setNextKmSum($dto->getNextKmSum())
            ->setStore($store)
            ->setRegion($region);

        $this->em->persist($entity);

        return $entity;
    }
}
