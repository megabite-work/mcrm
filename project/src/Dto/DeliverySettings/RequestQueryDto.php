<?php

namespace App\Dto\DeliverySettings;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank]
        private int $multiStoreId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank(allowNull: true)]
        private ?int $storeId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\NotBlank(allowNull: true)]
        private ?int $regionId,
        #[Groups(['delivery_settings:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['delivery_settings:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function getRegionId(): ?int
    {
        return $this->regionId;
    }

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }
}
