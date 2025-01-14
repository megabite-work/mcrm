<?php

declare(strict_types=1);

namespace App\Dto\WebFooterBody;

use App\Entity\WebFooterBody;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?int $webFooterId = null,
    ) {}

    public static function fromEntity(?WebFooterBody $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                webFooterId: $entity->getWebFooterId(),
            )
            : null;
    }
}
