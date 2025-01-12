<?php

declare(strict_types=1);

namespace App\Dto\WebEvent;

use App\Entity\WebEvent;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $multiStoreId = null,
        public ?string $title = null,
        public ?string $type = null,
        public string|array|null $typeIds = null,
        public ?string $animation = null,
        public ?string $move = null,
        public ?int $delay = null,
    ) {}

    public static function fromEntity(?WebEvent $entity, ?array $typeIds = null): ?static
    {
        return $entity
            ? new static(
                id: $entity?->getId(),
                multiStoreId: $entity?->getMultiStoreId(),
                title: $entity?->getTitle(),
                type: $entity?->getType(),
                typeIds: $typeIds ?? $entity?->getTypeIds(),
                animation: $entity?->getAnimation(),
                move: $entity?->getMove(),
                delay: $entity?->getDelay(),
            )
            : null;
    }
}
