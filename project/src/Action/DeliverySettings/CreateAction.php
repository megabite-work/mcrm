<?php

namespace App\Action\DeliverySettings;

use App\Entity\Store;
use App\Entity\Region;
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

    public function __invoke(RequestDto $dto): array
    {
        $stores = $this->storeRepository->findBy(['id' => $dto->getStores()]);
        $regions = $this->regionRepository->findBy(['id' => $dto->getRegions()]);

        $entities = [];
        foreach ($stores as $store) {
            foreach ($regions as $region) {
                $entity = $this->create($dto, $store, $region);
                $this->em->persist($entity);
                $entities[] = $entity;
            }
        }

        $this->em->flush();

        return $entities;
    }

    private function create(RequestDto $dto, Store $store, Region $region): DeliverySettings
    {
        $entity = (new DeliverySettings())
            ->setDeliveryType($dto->getDeliveryType())
            ->setMinSum($dto->getMinSum())
            ->setFirstKm($dto->getFirstKm())
            ->setDeliverySum($dto->getDeliverySum())
            ->setNextKmSum($dto->getNextKmSum())
            ->setStore($store)
            ->setRegion($region);

        return $entity;
    }
}
