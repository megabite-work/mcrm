<?php

declare(strict_types=1);

namespace App\Dto\WebFooterBody;

use App\Entity\WebFooterBody;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $logo = null,
        public ?string $about = null,
        public ?bool $isActive = null,
    ) {}

    public static function fromEntity(?WebFooterBody $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                logo: $entity->getLogo(),
                about: $entity->getAbout(),
                isActive: $entity->getIsActive(),
            )
            : null;
    }
}
