<?php

namespace App\Dto\Store;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        private ?string $name,
        private ?bool $isActive,
        private ?string $region,
        private ?string $district,
        private ?string $street,
        private ?string $house,
        private ?string $latitude,
        private ?string $longitude,
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
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
}
