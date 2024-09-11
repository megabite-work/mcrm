<?php

namespace App\Action\DeliverySettings;

use App\Component\EntityNotFoundException;
use App\Entity\DeliverySettings;
use App\Repository\DeliverySettingsRepository;

class ShowAction
{
    public function __construct(private DeliverySettingsRepository $repo)
    {
    }

    public function __invoke(int $id): DeliverySettings
    {
        $entity = $this->repo->findDeliverySettingsByIdWithStoreAndRegion($id);

        if (null == $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $entity;
    }
}
