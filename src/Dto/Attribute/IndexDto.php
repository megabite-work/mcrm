<?php

namespace App\Dto\Attribute;

use App\Dto\Value\IndexDto as ValueIndexDto;
use App\Entity\AttributeEntity;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $groupId = null,
        public string|array|null $name = null,
        public string|array|null $unit = null,
        public ?array $values = null,
    ) {}

    public static function fromEntity(?AttributeEntity $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                groupId: $entity->getGroup()->getId(),
                name: $entity->getName(),
                unit: $entity->getUnit()
            )
            : null;
    }

    public static function fromAttributeGroupWithValues(?AttributeEntity $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                groupId: $entity->getGroup()->getId(),
                name: $entity->getName(),
                unit: $entity->getUnit(),
                values: ValueIndexDto::fromArray($entity->getAttributeValues()->toArray()),
            )
            : null;
    }

    public static function fromArray(array $entities = []): array
    {
        return array_map(fn(AttributeEntity $entity) => static::fromAttributeGroupWithValues($entity), $entities);
    }
}
