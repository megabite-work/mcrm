<?php

namespace App\Dto\StoreNomenclature;

use App\Component\Paginator;
use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['store_nomenclature:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['store_nomenclature:index'])]
        #[Exists(Category::class)]
        public ?int $categoryId = null,
        #[Groups(['store_nomenclature:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['store_nomenclature:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
