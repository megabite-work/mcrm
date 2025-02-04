<?php

namespace App\Dto\Attribute;

use App\Entity\AttributeEntity;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $groupId = null,
        public string|array|null $name = null,
        public string|array|null $unit = null,
    ) {}

    public static function fromEntity(?AttributeEntity $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                groupId: $entity->getGroupId(),
                name: $entity->getName(),
                unit: $entity->getUnit()
            )
            : null;
    }
}
