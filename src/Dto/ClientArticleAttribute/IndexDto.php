<?php

namespace App\Dto\ClientArticleAttribute;

use App\Entity\ClientArticleAttribute;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $article = null,
        public string|array|null $attribute = null,
    ) {}

    public static function fromEntity(?ClientArticleAttribute $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                article: $entity->getArticle(),
                attribute: $entity->getAttribute(),
            )
            : null;
    }
}
