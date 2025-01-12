<?php

declare(strict_types=1);

namespace App\Dto\Permission;

use App\Entity\Permission;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $name = null,
        public ?string $icon = null,
        public ?string $resource = null,
        public ?string $action = null,
    ) {}

    public static function fromEntity(Permission $entity): static
    {
        return $entity
            ? new static(
                $entity->getId(),
                $entity->getName(),
                $entity->getIcon(),
                $entity->getResource(),
                $entity->getAction(),
            )
            : null;
    }
}
