<?php

namespace App\Action\DeliverySettings;

use App\Component\Paginator;
use App\Dto\DeliverySettings\RequestQueryDto;
use App\Repository\DeliverySettingsRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IndexAction
{
    public function __construct(
        private DeliverySettingsRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return match (true) {
            $dto->getStoreId() && $dto->getRegionId() => $this->repo->findAllDeliverySettingsByStoreAndRegion($dto),
            !is_null($dto->getStoreId()) => $this->repo->findAllDeliverySettingsByStore($dto),
            !is_null($dto->getRegionId()) => $this->repo->findAllDeliverySettingsByRegion($dto),
            default => throw new NotFoundHttpException("must be one of regionid or storeId")            
        };
    }
}