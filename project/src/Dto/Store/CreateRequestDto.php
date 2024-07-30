<?php

namespace App\Dto\Store;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        private ?string $name,
        #[Assert\NotBlank()]
        private int $multiStoreId,
        private ?string $officialAddress,
        private ?string $coordinate,
        private ?bool $isActive,
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

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }
}
