<?php

namespace App\Dto\User;

final class UpdateRequestDto
{
    public function __construct(
        private ?string $email,
        private ?string $region,
        private ?string $district,
        private ?string $street,
        private ?string $house,
        private ?string $latitude,
        private ?string $longitude,
        private ?array $phones
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
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

    public function getPhones(): ?array
    {
        return $this->phones;
    }
}
