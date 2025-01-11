<?php

namespace App\Dto\Value;

use App\Entity\AttributeEntity;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['value:create'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        #[Exists(entity: AttributeEntity::class)]
        public ?int $attributeId,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        public ?string $nameUz,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        public ?string $nameUzc,
        #[Groups(['value:create', 'value:update'])]
        #[Assert\NotBlank(groups: ['value:create'])]
        public ?string $nameRu,
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
