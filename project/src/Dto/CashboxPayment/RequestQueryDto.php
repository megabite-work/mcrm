<?php

namespace App\Dto\CashboxPayment;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.getCashboxDetailId() != null',
            constraints: [new Assert\Positive]
        )]
        private ?int $cashboxDetailId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.getPaymentTypeId() != null',
            constraints: [new Assert\Positive]
        )]
        private ?int $paymentTypeId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\When(
            expression: 'this.getPaymentTypeId() != null && this.getCashboxDetailId() == null',
            constraints: [new Assert\NotBlank(message: "cashboxId should not be blank."), new Assert\Positive]
        )]
        private ?int $cashboxId,
        #[Groups(['cashbox_payment:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['cashbox_payment:index'])]
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

    public function getCashboxDetailId(): ?int
    {
        return $this->cashboxDetailId;
    }

    public function getPaymentTypeId(): ?int
    {
        return $this->paymentTypeId;
    }

    public function getCashboxId(): ?int
    {
        return $this->cashboxId;
    }
}
