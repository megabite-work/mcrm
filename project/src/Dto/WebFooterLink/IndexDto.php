<?php

declare(strict_types=1);

namespace App\Dto\WebFooterLink;

use App\Entity\WebFooterLink;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        private ?int $webFooterBodyId = null,
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
                webFooterBodyId: $entity->getWebFooterBodyId(),
                title: $entity->getTitle(),
                type: $entity->getType(),
                isActive: $entity->isIsActive(),
                link: $entity->getLink(),
            )
            : null;
    }
}
