<?php

declare(strict_types=1);

namespace App\Dto\Region;

use App\Entity\Region;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
    ) {}

    public static function fromEntity(?Region $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName()
            )
            : null;
    }
}
