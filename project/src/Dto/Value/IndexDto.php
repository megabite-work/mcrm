<?php

declare(strict_types=1);

namespace App\Dto\Value;

use App\Entity\ValueEntity;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
    ) {}

    public static function fromEntity(?ValueEntity $entity): ?static
    {
        return $entity
            ? new static(id: $entity->getId(), name: $entity->getName())
            : null;
    }
}
