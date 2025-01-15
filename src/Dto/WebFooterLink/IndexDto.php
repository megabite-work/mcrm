<?php

declare(strict_types=1);

namespace App\Dto\WebFooterLink;

use App\Entity\WebFooterLink;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        private ?int $webFooterId = null,
        private ?string $title = null,
        private ?string $type = null,
        private ?bool $isActive = true,
        private ?string $link = null,

    ) {}

    public static function fromEntity(?WebFooterLink $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                webFooterId: $entity->getWebFooterId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->getIsActive(),
                link: $entity->getLink(),
            )
            : null;
    }
}
