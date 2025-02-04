<?php

namespace App\Dto\AttributeGroup;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestDto
{
    public function __construct(
        #[Groups(['attribute_group:create', 'attribute_group:update'])]
        #[Assert\NotBlank(groups: ['attribute_group:create'])]
        public ?string $nameUz,
        #[Groups(['attribute_group:create', 'attribute_group:update'])]
        #[Assert\NotBlank(groups: ['attribute_group:create'])]
        public ?string $nameUzc,
        #[Groups(['attribute_group:create', 'attribute_group:update'])]
        #[Assert\NotBlank(groups: ['attribute_group:create'])]
        public ?string $nameRu,
    ) {
    }

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
