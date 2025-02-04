<?php

declare(strict_types=1);

namespace App\Dto\WebBanner;

use App\Entity\WebBanner;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?string $type = null,
        public ?string $typeId = null,
        public string|array|null $showType = null,
        public string|array|null $showTypeId = null,
        public string|array|null $image = null,
        public ?bool $isActive = false,
        public ?string $title = null,
        public ?string $description = null,
        public string|array|null $devices = null,
        public ?string $clickType = null,
        public ?int $clickMax = 0,
        public ?int $clickCurrent = 0,
        public ?string $viewType = null,
        public ?int $viewMax = 0,
        public ?int $viewCurrent = 0,
        public ?string $beginAt = null,
        public ?string $endAt = null,

    ) {}

    public static function fromEntity(?WebBanner $entity, ?object $typeId = null, ?array $showTypeId = null): static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                type: $entity->getType(),
                typeId: $typeId ?? $entity->getTypeId(),
                showType: $entity->getShowType(),
                showTypeId: $showTypeId ?? $entity->getShowTypeId(),
                image: $entity->getImage(),
                isActive: $entity->getIsActive(),
                title: $entity->getTitle(),
                description: $entity->getDescription(),
                devices: $entity->getDevices(),
                clickType: $entity->getClickType(),
                clickMax: $entity->getClickMax(),
                clickCurrent: $entity->getClickCurrent(),
                viewType: $entity->getViewType(),
                viewMax: $entity->getViewMax(),
                viewCurrent: $entity->getViewCurrent(),
                beginAt: $entity->getBeginAt(),
                endAt: $entity->getEndAt(),
            )
            : null;
    }

    public static function fromArray(?array $entity): static
    {
        return $entity
            ? new static(
                id: $entity['id'],
                type: $entity['type'],
                typeId: $entity['type_id'],
                showType: json_decode($entity['show_type'], true),
                showTypeId: json_decode($entity['show_type_id'], true),
                image: json_decode($entity['image'], true),
                isActive: (bool)$entity['is_active'],
                title: $entity['title'],
                description: $entity['description'],
                devices: json_decode($entity['devices'], true),
                clickType: $entity['click_type'],
                clickMax: $entity['click_max'],
                clickCurrent: $entity['click_current'],
                viewType: $entity['view_type'],
                viewMax: $entity['view_max'],
                viewCurrent: $entity['view_current'],
                beginAt: $entity['begin_at'],
                endAt: $entity['end_at'],
            )
            : null;
    }
}
