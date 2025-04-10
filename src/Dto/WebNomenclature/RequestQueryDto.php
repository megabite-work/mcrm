<?php

namespace App\Dto\WebNomenclature;

use App\Component\Paginator;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_nomenclature:index'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:index'])]
        #[Exists(MultiStore::class)]
        public int $multiStoreId,
        #[Groups(['web_nomenclature:index'])]
        #[Exists(Nomenclature::class)]
        public ?int $nomenclatureId,
        #[Groups(['web_nomenclature:index'])]
        #[Exists(Category::class)]
        public ?int $categoryId,
        #[Groups(['web_nomenclature:index'])]
        public ?string $title,
        #[Groups(['web_nomenclature:index'])]
        public ?bool $isActive = null,
        #[Groups(['web_nomenclature:index'])]
        public ?bool $groupByArticle = null,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['web_nomenclature:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
