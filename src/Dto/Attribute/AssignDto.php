<?php

namespace App\Dto\Attribute;

use App\Entity\AttributeEntity;
use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class AssignDto
{
    public function __construct(
        #[Groups(['attribute:assign'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(entity: Category::class)]
        public int $categoryId,
        #[Groups(['attribute:assign'])]
        #[Assert\All([
            new Assert\NotBlank(groups: ['attribute:assign']),
            new Assert\Positive(groups: ['attribute:assign']),
            new Exists(AttributeEntity::class, groups: ['attribute:assign'])
        ], groups: ['attribute:assign'])]
        public ?array $attributeIds = [],
    ) {}
}
