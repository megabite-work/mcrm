<?php

declare(strict_types=1);

namespace App\Dto\WebBannerSetting;

use App\Entity\WebBannerSetting;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?array $webBannerIds = null,
        public ?string $animation = null,
        public ?string $move = null,
        public ?int $delay = null,
        public ?int $speed = null,
    ) {}

    public static function fromEntity(?WebBannerSetting $entity): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                webBannerIds: $entity->getWebBannerIds(),
                animation: $entity->getAnimation(),
                move: $entity->getMove(),
                delay: $entity->getDelay(),
                speed: $entity->getSpeed()
            )
            : null;
    }
}
