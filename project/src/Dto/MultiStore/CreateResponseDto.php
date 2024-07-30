<?php

namespace App\Dto\MultiStore;

use App\Entity\User;

final class CreateResponseDto
{
    public function __construct(
        private int $id,
        private string $name,
        private string $profit,
        private string $barcodeTtn,
        private string $nds,
        private User $owner,
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

    public function getProfit(): string
    {
        return $this->profit;
    }

    public function getBarcodeTtn(): string
    {
        return $this->barcodeTtn;
    }

    public function getNds(): string
    {
        return $this->nds;
    }

    public function getOwner(): User
    {
        return $this->owner;
    }
}
