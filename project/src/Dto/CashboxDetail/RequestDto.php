<?php

namespace App\Dto\CashboxDetail;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_detail:create'])]
        #[Assert\NotBlank(groups: ['cashbox_detail:create'])]
        private int $cashboxId,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\Choice(choices: ['sale', 'return'])]
        private ?string $type,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create'])]
        private ?int $counterPartId,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:update'])]
        private ?int $detailId,
        #[Groups(['cashbox_detail:create'])]
        #[Assert\Choice(choices: ['credit', 'advance', 'credit_pay', null])]
        private ?string $creditType = null,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\Choice(choices: [true, false])]
        private ?bool $returnStatus = false,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\Choice(choices: [true, false, null])]
        private ?bool $creditStatus = null,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $surrender = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $sale = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $discount = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $nds = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $advance = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $credit = 0,
        #[Groups(['cashbox_detail:create', 'cashbox_detail:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['cashbox_detail:create', 'cashbox_detail:update'])]
        private ?float $remain = 0,
        private ?int $chequeNumber = null,

    ) {}

    public function getCashboxId(): int
    {
        return $this->cashboxId;
    }

    public function getChequeNumber(): ?int
    {
        return $this->chequeNumber;
    }

    public function setChequeNumber(?int $chequeNumber): ?int
    {
        return $this->chequeNumber = $chequeNumber;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getReturnStatus(): ?bool
    {
        return $this->returnStatus;
    }

    public function getCreditStatus(): ?bool
    {
        return $this->creditStatus;
    }

    public function getCreditType(): ?string
    {
        return $this->creditType;
    }

    public function getSale(): ?float
    {
        return $this->sale;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function getAdvance(): ?float
    {
        return $this->advance;
    }

    public function getRemain(): ?float
    {
        return $this->remain;
    }

    public function getCounterPartId(): ?int
    {
        return $this->counterPartId;
    }

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function getSurrender(): ?float
    {
        return $this->surrender;
    }

    public function getCredit(): ?float
    {
        return $this->credit;
    }

    public function getDetailId(): ?int
    {
        return $this->detailId;
    }
}
