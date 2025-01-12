<?php

declare(strict_types=1);

namespace App\Dto\NomenclatureHistory;

use App\Dto\ForgiveType\IndexDto as ForgiveTypeDto;
use App\Dto\Nomenclature\IndexDto as NomenclatureDto;
use App\Dto\Store\IndexDto as StoreDto;
use App\Dto\User\IndexDto as UserDto;
use App\Entity\NomenclatureHistory;

final readonly class IndexDto
{
    public function __construct(
        public ?int $id = null,
        public ?NomenclatureDto $nomenclature = null,
        public ?StoreDto $store = null,
        public ?ForgiveTypeDto $forgiveType = null,
        public ?UserDto $owner = null,
        public ?string $comment = null,
        public ?float $qty = 0,
        public ?float $oldPrice = 0,
        public ?float $price = 0,
        public ?float $oldPriceCourse = 0,
        public ?float $priceCourse = 0,
    ) {}

    public static function fromEntity(?NomenclatureHistory $entity): ?static
    {
        return $entity
            ? new static(
                $entity->getId(),
                NomenclatureDto::fromEntity($entity->getNomenclature()),
                StoreDto::fromEntity($entity->getStore()),
                ForgiveTypeDto::fromEntity($entity->getForgiveType()),
                UserDto::fromEntity($entity->getOwner()),
                $entity->getComment(),
                $entity->getQty(),
                $entity->getOldPrice(),
                $entity->getPrice(),
                $entity->getOldPriceCourse(),
                $entity->getPriceCourse(),
            )
            : null;
    }
    
    public static function fromCreateAction(?NomenclatureHistory $entity): ?static
    {
        return $entity
            ? new static(
                $entity->getId(),
                $entity->getComment(),
                $entity->getQty(),
                $entity->getOldPrice(),
                $entity->getPrice(),
                $entity->getOldPriceCourse(),
                $entity->getPriceCourse(),
            )
            : null;
    }
}
