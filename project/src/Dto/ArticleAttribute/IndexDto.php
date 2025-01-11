<?php

namespace App\Dto\ArticleAttribute;

use App\Entity\ArticleAttribute;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $article = null,
        public string|array|null $attributes = null,
    ) {}

    public static function fromEntity(?ArticleAttribute $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                article: $entity->getArticle(),
                attributes: $entity->getAttributes(),
            )
            : null;
    }
}
