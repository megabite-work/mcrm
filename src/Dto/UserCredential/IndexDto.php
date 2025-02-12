<?php

declare(strict_types=1);

namespace App\Dto\UserCredential;

use App\Entity\UserCredential;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public string|array|null $value = null,
    ) {}

    public static function fromEntity(?UserCredential $entity): ?static
    {
        return $entity
            ? new static(
                $entity->getId(),
                $entity->getType(),
                $entity->getValue()
            )
            : null;
    }

    public static function fromEntityArray(array $entities): array
    {
        return array_map(fn(UserCredential $entity) => self::fromEntity($entity), $entities);
    }
}
