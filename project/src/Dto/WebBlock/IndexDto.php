<?php

declare(strict_types=1);

namespace App\Dto\WebBlock;

use App\Entity\WebBlock;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public ?string $title = null,
        public ?bool $isActive = null,
        public ?int $typeId = null,
        public ?int $order = null,
    ) {}

    public static function fromEntity(?WebBlock $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                type: $entity->getType(),
                title: $entity->getTitle(),
                isActive: $entity->getIsActive(),
                typeId: $entity->getTypeId(),
                order: $entity->getOrder(),
            )
            : null;
    }
}
