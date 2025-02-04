<?php

namespace App\Dto\Attribute;

use App\Component\Paginator;
use App\Entity\AttributeGroup;
use App\Entity\Category;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestQueryDto
{
    public function __construct(
        #[Groups(['attribute:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(entity: Category::class)]
        public int $categoryId,
        #[Groups(['attribute:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Exists(entity: AttributeGroup::class)]
        public ?int $groupId,
        #[Groups(['attribute:index'])]
        #[Assert\NotBlank(allowNull: true, groups: ['attribute:index'])]
        #[Assert\Type(type: ['string', 'null'], groups: ['attribute:index'])]
        public ?string $name = null,
        #[Groups(['attribute:index'])]
        #[Assert\Positive]
        public ?int $page = 1,
        #[Groups(['attribute:index'])]
        #[Assert\Positive]
        public ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }
}
