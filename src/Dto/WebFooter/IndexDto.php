<?php

declare(strict_types=1);

namespace App\Dto\WebFooter;

use App\Dto\WebFooterLink\IndexDto as WebFooterLinkIndexDto;
use App\Entity\WebFooter;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $title = null,
        public ?string $type = null,
        public ?bool $isActive = null,
        public ?int $order = null,
        public ?array $links = null,
    ) {}

    public static function fromEntity(?WebFooter $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                order: $entity->getOrder(),
            )
            : null;
    }

    public static function fromEntityWithRelation(?WebFooter $entity, ?array $links = []): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                order: $entity->getOrder(),
                links: static::prepareLinks($entity->getType(), $links),
            )
            : null;
    }

    private static function prepareLinks(string $type, ?array $links = []): array
    {
        return array_map(function ($link) use ($type) {
            if (in_array($type, [WebFooter::TYPE_CONTACT, WebFooter::TYPE_SOCIAL])) {
                return new WebFooterLinkIndexDto(
                    id: $link->getId(),
                    webFooterId: $link->getWebFooterId(),
                    type: $link->getType(),
                    isActive: $link->getIsActive(),
                );
            }

            return WebFooterLinkIndexDto::fromEntity($link);
        }, $links);
    }
}
