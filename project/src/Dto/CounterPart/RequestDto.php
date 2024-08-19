<?php

namespace App\Dto\CounterPart;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['counter_part:create'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        private int $multiStoreId,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        private string $name,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(groups: ['counter_part:create'])]
        private ?string $inn,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['counter_part:create', 'counter_part:update'])]
        private ?float $discount,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $region,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $district,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $street,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $house,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $latitude,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?string $longitude,
        #[Groups(['counter_part:create', 'counter_part:update'])]
        private ?array $phones,
    ) {}

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function getPhones(): array
    {
        return $this->phones ?? [];
    }
}
