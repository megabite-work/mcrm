<?php

namespace App\Dto\AttributeGroup;

use App\Entity\AttributeGroup;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?array $name = null,
    ) {}

    public static function fromEntity(?AttributeGroup $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName()
            )
            : null;
    }
}
