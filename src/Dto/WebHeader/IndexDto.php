<?php

declare(strict_types=1);

namespace App\Dto\WebHeader;

use App\Entity\WebHeader;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public ?bool $isActive = null,
        public ?int $order = null,
    ) {}

    public static function fromEntity(?WebHeader $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                order: $entity->getOrder(),
            )
            : null;
    }
}
