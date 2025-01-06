<?php

namespace App\Dto\StoreNomenclature;

use App\Entity\Nomenclature;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['store_nomenclature:create'])]
        #[Assert\NotBlank(groups: ['store_nomenclature:create'])]
        #[Exists(Nomenclature::class)]
        public ?int $nomenclatureId,
        #[Groups(['store_nomenclature:create', 'store_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['store_nomenclature:create', 'store_nomenclature:update'])]
        public ?float $qty
    ) {}
}
