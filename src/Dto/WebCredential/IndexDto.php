<?php

declare(strict_types=1);

namespace App\Dto\WebCredential;

use App\Entity\WebCredential;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $catalogType = null,
        public string|array|null $catalogTypeId = null,
        public ?string $buyTitle = null,
        public ?string $buyType = null,
        public ?string $buyValue = null,
        public ?int $article = null,
        public ?string $logo = null,
        public string|array|null $secrets = null,
        public string|array|null $social = null,
        public ?int $templateId = null,
    ) {}

    public static function fromEntity(WebCredential $entity, ?array $catalogTypes = null): static
    {
        return new static(
            id: $entity->getId(),
            catalogType: $entity->getCatalogType(),
            catalogTypeId: $catalogTypes ?? $entity->getCatalogTypeId(),
            buyTitle: $entity->getBuyTitle(),
            buyType: $entity->getBuyType(),
            buyValue: $entity->getBuyValue(),
            article: $entity->getArticle(),
            logo: $entity->getLogo(),
            secrets: $entity->getSecrets(),
            social: $entity->getSocial(),
            templateId: $entity->getTemplateId(),
        );
    }
}
