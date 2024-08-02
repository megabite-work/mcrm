<?php

namespace App\Dto\User;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['user:create', 'user:update'])]
        #[Assert\Email(groups: ['user:create'])]
        #[Assert\NotBlank(groups: ['user:create'])]
        private ?string $email,
        #[Groups(['user:create'])]
        #[Assert\NotBlank(groups: ['user:create'])]
        #[Assert\Length(min: 3)]
        private ?string $username,
        #[Groups(['user:create'])]
        #[Assert\NotBlank(groups: ['user:create'])]
        #[Assert\Length(min: 6)]
        private ?string $password,
        #[Groups(['user:update'])]
        private ?string $region,
        #[Groups(['user:update'])]
        private ?string $district,
        #[Groups(['user:update'])]
        private ?string $street,
        #[Groups(['user:update'])]
        private ?string $house,
        #[Groups(['user:update'])]
        private ?string $latitude,
        #[Groups(['user:update'])]
        private ?string $longitude,
        #[Groups(['user:update'])]
        private ?array $phones
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
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
