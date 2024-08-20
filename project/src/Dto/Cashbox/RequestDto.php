<?php

namespace App\Dto\Cashbox;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox:create', 'cashbox:update'])]
        #[Assert\NotBlank(groups: ['cashbox:create'])]
        private ?string $name,
        #[Groups(['cashbox:create'])]
        #[Assert\NotBlank(groups: ['cashbox:create'])]
        private ?int $storeId,
        #[Groups(['cashbox:update'])]
        private ?string $terminalId,
        #[Groups(['cashbox:update'])]
        private ?int $shiftNumber,
        #[Groups(['cashbox:update'])]
        private ?int $zNumber,
        #[Groups(['cashbox:update'])]
        private ?int $xNumber,
        #[Groups(['cashbox:update'])]
        private ?string $workplace,
        #[Groups(['cashbox:update'])]
        private ?string $humoArcusFolder,
        #[Groups(['cashbox:update'])]
        #[Assert\Type('bool', groups: ['cashbox:update'])]
        private ?bool $isActive = true
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function getTerminalId(): ?string
    {
        return $this->terminalId;
    }

    public function getShiftNumber(): ?int
    {
        return $this->shiftNumber;
    }

    public function getZNumber(): ?int
    {
        return $this->zNumber;
    }

    public function getXNumber(): ?int
    {
        return $this->xNumber;
    }

    public function getWorkplace(): ?string
    {
        return $this->workplace;
    }

    public function getHumoArcusFolder(): ?string
    {
        return $this->humoArcusFolder;
    }
}
