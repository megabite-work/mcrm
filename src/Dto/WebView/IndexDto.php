<?php

declare(strict_types=1);

namespace App\Dto\WebView;

use App\Entity\WebView;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public ?bool $isActive = null,
    ) {}

    public static function fromEntity(?WebView $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
            )
            : null;
    }
}
