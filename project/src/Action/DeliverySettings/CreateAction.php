<?php

namespace App\Action\DeliverySettings;

use App\Entity\Store;
use App\Entity\Region;
use App\Entity\DeliverySettings;
use App\Dto\DeliverySettings\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): DeliverySettings
    {
        $store = $this->em->find(Store::class, $dto->getStoreId());
        $region = $this->em->find(Region::class, $dto->getRegionId());

        if (null === $store || null === $region) {
            throw new EntityNotFoundException('store or region not found');
        }

        $entity = $this->create($dto, $store, $region);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
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
