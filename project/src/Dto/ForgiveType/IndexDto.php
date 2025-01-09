<?php

namespace App\Dto\ForgiveType;

use App\Entity\ForgiveType;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,

    ) {}

    public static function fromEntity(?ForgiveType $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                name: $entity->getName(),
            )
            : null;
    }
}
