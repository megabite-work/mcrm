<?php

namespace App\Dto\Category;

use App\Entity\Category;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $parentId = null,
        public ?array $name = null,
        public ?string $image = null,
        public ?bool $isActive = null,
        public ?bool $hasChild = false,
    ) {}

    public static function fromEntity(?Category $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                parentId: $entity->getParentId(),
                name: $entity->getName(),
                image: $entity->getImage(),
                isActive: $entity->getIsActive(),
                hasChild: $entity->getHasChild(),
            )
            : null;
    }
}
