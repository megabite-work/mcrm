<?php

namespace App\Dto\ClientArticleAttributeValue;

use App\Entity\ClientArticleAttributeValue;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public string|array|null $attribute = null,
        public ?string $value = null,
    ) {}

    public static function fromEntity(?ClientArticleAttributeValue $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                attribute: $entity->getAttribute(),
                value: $entity->getValue(),
            )
            : null;
    }
}
