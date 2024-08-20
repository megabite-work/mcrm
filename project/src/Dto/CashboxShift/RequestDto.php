<?php

namespace App\Dto\CashboxShift;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        private ?int $cashboxId,
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        private ?int $userId,
        #[Groups(['cashbox_shift:create'])]
        #[Assert\NotBlank(groups: ['cashbox_shift:create'])]
        private ?int $shiftNumber
    ) {
    }

    public function getCashboxId(): ?int
    {
        return $this->cashboxId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getShiftNumber(): ?int
    {
        return $this->shiftNumber;
    }
}
