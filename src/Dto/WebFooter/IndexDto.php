<?php

declare(strict_types=1);

namespace App\Dto\WebFooter;

use App\Entity\WebFooter;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $title = null,
        public ?string $type = null,
        public ?bool $isActive = null,
        public ?int $order = null,
        public ?array $links = null,
    ) {}

    public static function fromEntity(?WebFooter $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                order: $entity->getOrder(),
            )
            : null;
    }

    public static function fromEntityWithRelation(?WebFooter $entity, ?array $links = []): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                order: $entity->getOrder(),
                links: $links,
            )
            : null;
    }
}
