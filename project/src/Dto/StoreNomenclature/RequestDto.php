<?php

namespace App\Dto\StoreNomenclature;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['store_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['store_nomenclature:update'])]
        private ?float $qty
    ) {
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }
}
