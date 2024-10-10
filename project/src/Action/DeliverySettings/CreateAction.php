<?php

namespace App\Action\DeliverySettings;

use App\Component\EntityNotFoundException;
use App\Entity\DeliverySettings;
use App\Dto\DeliverySettings\RequestDto;
use App\Entity\Region;
use App\Entity\Store;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(array $dtos): array
    {
        $this->em->beginTransaction();
        $entities = [];

        try {
            foreach ($dtos as $dto) {
                $entity = $this->create($dto);
                $entities[] = $entity;
            }

            $this->em->flush();
            $this->em->commit();
        } catch (\Throwable $th) {
            $this->em->rollback();
            throw new EntityNotFoundException($th->getMessage(), $th->getCode());
        }

        return $entities;
    }

    private function create(RequestDto $dto): DeliverySettings
    {
        $store = $this->em->find(Store::class, $dto->getStoreId());
        $region = $this->em->find(Region::class, $dto->getRegionid());

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
