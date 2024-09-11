<?php

namespace App\Action\DeliverySettings;

use App\Component\EntityNotFoundException;
use App\Dto\DeliverySettings\RequestDto;
use App\Entity\DeliverySettings;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): DeliverySettings
    {
        $entity = $this->em->find(DeliverySettings::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($dto, $entity);

        $this->em->flush();

        return $entity;
    }

    private function update(RequestDto $dto, DeliverySettings $entity): DeliverySettings
    {
        if ($dto->getDeliveryType()) {
            $entity->setDeliveryType($dto->getDeliveryType());
        }
        if ($dto->getMinSum()) {
            $entity->setMinSum($dto->getMinSum());
        }
        if ($dto->getFirstKm()) {
            $entity->setFirstKm($dto->getFirstKm());
        }
        if ($dto->getDeliverySum()) {
            $entity->setDeliverySum($dto->getDeliverySum());
        }
        if ($dto->getNextKmSum()) {
            $entity->setNextKmSum($dto->getNextKmSum());
        }

        return $entity;
    }
}
