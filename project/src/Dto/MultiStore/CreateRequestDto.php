<?php

namespace App\Dto\MultiStore;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateRequestDto
{
    public function __construct(
        #[Assert\NotBlank]
        private ?string $name,
        private ?string $profit,
        private ?int $barcodeTtn,
        private ?int $nds,
    ) {
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getProfit(): ?string
    {
        return $this->profit;
    }

    public function getBarcodeTtn(): ?int
    {
        return $this->barcodeTtn;
    }

    public function getNds(): ?int
    {
        return $this->nds;
    }
}
