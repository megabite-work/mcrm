<?php

namespace App\Dto\Store;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        private ?string $name,
        private ?string $officialAddress,
        private ?string $coordinate,
        private ?bool $isActive
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getOfficialAddress(): ?string
    {
        return $this->officialAddress;
    }

    public function getCoordinate(): ?string
    {
        return $this->coordinate;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
}
