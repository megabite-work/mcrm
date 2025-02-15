<?php

namespace App\Dto\AttributeGroup;

use App\Dto\Attribute\IndexDto as AttributeIndexDto;
use App\Entity\AttributeGroup;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
        public ?array $attributes = null,
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

    public static function fromWithFullRelation(?AttributeGroup $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName(),
                attributes: AttributeIndexDto::fromArray($entity->getAttributeEntities()->toArray()),
            )
            : null;
    }
}
