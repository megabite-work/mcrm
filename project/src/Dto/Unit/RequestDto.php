<?php

namespace App\Dto\Unit;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        public ?string $nameUz,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        public ?string $nameUzc,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        public ?string $nameRu,
        #[Groups(['unit:create', 'unit:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['unit:create', 'unit:update'])]
        public ?string $icon,
        #[Groups(['unit:create'])]
        #[Assert\NotBlank(groups: ['unit:create'])]
        public ?int $code
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
