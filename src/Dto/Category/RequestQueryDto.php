<?php

namespace App\Dto\Category;

use App\Component\Paginator;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestQueryDto
{
    public function __construct(
        #[Groups(['category:index'])]
        #[Assert\Type(type: ['integer', 'null'])]
        #[Exists(Category::class)]
        public ?int $parentId = null,
        #[Groups(['category:index'])]
        #[Assert\Type(type: ['integer', 'null'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId = null,
        #[Groups(['category:index'])]
        #[Assert\Choice(choices: Category::GENERATIONS)]
        public ?string $generation = null,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        public ?int $page = 1,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        public ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
