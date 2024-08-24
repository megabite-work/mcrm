<?php

namespace App\Dto\CashboxDetail;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_detail:index'])]
        #[Assert\NotBlank(groups: ['cashbox_detail:index'])]
        #[Assert\Positive]
        private int $cashboxId,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: ['sale', 'return', null])]
        private ?string $type = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: [true, false, null])]
        private ?bool $returnStatus = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: [true, false, null])]
        private ?bool $creditStatus = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Choice(choices: ['credit', 'advance', 'credit_pay', null])]
        private ?string $creditType = null,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['cashbox_detail:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getCashboxId(): int
    {
        return $this->cashboxId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getCreditType(): ?string
    {
        return $this->creditType;
    }

    public function getCreditStatus(): ?bool
    {
        return $this->creditStatus;
    }

    public function getReturnStatus(): ?bool
    {
        return $this->returnStatus;
    }
}
