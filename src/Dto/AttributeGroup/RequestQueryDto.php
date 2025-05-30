<?php

namespace App\Dto\AttributeGroup;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestQueryDto
{
    public function __construct(
        #[Groups(['attribute_group:index'])]
        #[Assert\Type(type: ['string', 'null'], groups: ['attribute_group:index'])]
        public ?string $name,
        #[Groups(['attribute_group:index'])]
        #[Assert\Type(type: ['bool', 'null'], groups: ['attribute_group:index'])]
        public ?bool $isFull = null,
        #[Groups(['attribute_group:index'])]
        #[Assert\Positive(groups: ['attribute_group:index'])]
        public ?int $page = 1,
        #[Groups(['attribute_group:index'])]
        #[Assert\Positive(groups: ['attribute_group:index'])]
        public ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
