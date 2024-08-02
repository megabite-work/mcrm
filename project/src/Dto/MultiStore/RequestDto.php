<?php

namespace App\Dto\MultiStore;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['multi_store:create', 'multi_store:update'])]
        #[Assert\NotBlank(groups: ['multi_store:create'])]
        private ?string $name,
        #[Groups(['multi_store:create', 'multi_store:update'])]
        private ?string $profit,
        #[Groups(['multi_store:create', 'multi_store:update'])]
        private ?string $barcodeTtn,
        #[Groups(['multi_store:create', 'multi_store:update'])]
        private ?int $nds,
        #[Groups(['multi_store:update'])]
        private ?string $region,
        #[Groups(['multi_store:update'])]
        private ?string $district,
        #[Groups(['multi_store:update'])]
        private ?string $street,
        #[Groups(['multi_store:update'])]
        private ?string $house,
        #[Groups(['multi_store:update'])]
        private ?string $latitude,
        #[Groups(['multi_store:update'])]
        private ?string $longitude,
        #[Groups(['multi_store:update'])]
        private ?array $phones
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getProfit(): ?string
    {
        return $this->profit;
    }

    public function getBarcodeTtn(): ?string
    {
        return $this->barcodeTtn;
    }

    public function getNds(): ?int
    {
        return $this->nds;
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
