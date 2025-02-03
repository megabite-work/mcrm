<?php

namespace App\Dto\Attribute;

use App\Entity\AttributeGroup;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestDto
{
    public function __construct(
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameUz,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameUzc,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $nameRu,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $unitUz,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $unitUzc,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        public ?string $unitRu,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        #[Exists(entity: AttributeGroup::class, groups: ['attribute:create'])]
        public int $groupId,
    ) {}

    public function getName(): ?array
    {
        return ['ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }

    public function getUnit(): ?array
    {
        return ['ru' => $this->unitRu, 'uz' => $this->unitUz, 'uzc' => $this->unitUzc];
    }
}
