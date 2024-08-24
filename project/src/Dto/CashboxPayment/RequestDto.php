<?php

namespace App\Dto\CashboxPayment;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        private ?int $cashboxDetailId,
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        private ?int $paymentTypeId,
        #[Groups(['cashbox_payment:create'])]
        #[Assert\NotBlank(groups: ['cashbox_payment:create'])]
        private ?float $amount
    ) {
    }

    public function getCashboxDetailId(): ?int
    {
        return $this->cashboxDetailId;
    }

    public function getPaymentTypeId(): ?int
    {
        return $this->paymentTypeId;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }
}
