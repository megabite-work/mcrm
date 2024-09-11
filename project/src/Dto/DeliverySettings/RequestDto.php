<?php

namespace App\Dto\DeliverySettings;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['delivery_settings:create'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        private array $stores = [],
        #[Groups(['delivery_settings:create'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        private array $regions = [],
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[Assert\Choice(choices: ['fixed', 'flexable'], groups: ['delivery_settings:create'])]
        private ?string $deliveryType,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        private ?float $minSum = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        private ?float $firstKm = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        private ?float $deliverySum = 0,
        #[Groups(['delivery_settings:create', 'delivery_settings:update'])]
        #[Assert\NotBlank(groups: ['delivery_settings:create'])]
        #[assert\PositiveOrZero(groups: ['delivery_settings:create'])]
        private ?float $nextKmSum = 0,
    ) {}

    public function getStores(): array
    {
        return $this->stores;
    }

    public function getRegions(): array
    {
        return $this->regions;
    }

    public function getDeliveryType(): ?string
    {
        return $this->deliveryType;
    }

    public function getMinSum(): ?float
    {
        return $this->minSum;
    }

    public function getFirstKm(): ?float
    {
        return $this->firstKm;
    }

    public function getDeliverySum(): ?float
    {
        return $this->deliverySum;
    }

    public function getNextKmSum(): ?float
    {
        return $this->nextKmSum;
    }
}
