<?php

namespace App\Dto\CashboxGlobal;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateRequestDto
{
    public function __construct(
        #[Assert\NotBlank(groups: ['cashbox_global:create'])]
        private ?int $nomenclatureId,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $qty = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $oldPrice = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $price = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $oldPriceCourse = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $priceCourse = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $nds = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $ndsSum = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $discount = 0,
        #[Groups(['cashbox_global:create', 'cashbox_global:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_global:create', 'cashbox_global:update'])]
        private ?float $discountSum = 0,
    ) {
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getOldPriceCourse(): ?float
    {
        return $this->oldPriceCourse;
    }

    public function getPriceCourse(): ?float
    {
        return $this->priceCourse;
    }

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function getNdsSum(): ?float
    {
        return $this->ndsSum;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getDiscountSum(): ?float
    {
        return $this->discountSum;
    }
}
