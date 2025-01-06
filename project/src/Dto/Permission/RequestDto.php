<?php

namespace App\Dto\Permission;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        public ?string $nameUz,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        public ?string $nameUzc,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        public ?string $nameRu,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['permission:create', 'permission:update'])]
        public ?string $icon,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        public ?string $resource,
        #[Groups(['permission:create', 'permission:update'])]
        #[Assert\NotBlank(groups: ['permission:create'])]
        public ?string $action,
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
