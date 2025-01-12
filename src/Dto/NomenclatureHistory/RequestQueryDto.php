<?php

namespace App\Dto\NomenclatureHistory;

use App\Component\Paginator;
use App\Entity\Store;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['nomenclature_history:index'])]
        #[Assert\NotBlank(groups: ['nomenclature_history:index'])]
        #[Exists(Store::class)]
        public ?int $storeId,
        #[Groups(['nomenclature_history:index'])]
        #[Assert\Positive(groups: ['nomenclature_history:index'])]
        public int $page = 1,
        #[Groups(['nomenclature_history:index'])]
        #[Assert\Positive(groups: ['nomenclature_history:index'])]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
