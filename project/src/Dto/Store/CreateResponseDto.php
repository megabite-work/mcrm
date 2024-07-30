<?php

namespace App\Dto\Store;

final class CreateResponseDto
{
    public function __construct(
        private int $id,
        private ?string $name,
        private ?string $officialAddress,
        private ?string $coordinate,
        private bool $isActive,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
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

    public function getIsActive(): bool
    {
        return $this->isActive;
    }
}
