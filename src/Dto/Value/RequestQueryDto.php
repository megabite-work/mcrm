<?php

namespace App\Dto\Value;

use App\Component\Paginator;
use App\Entity\AttributeEntity;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['value:index'])]
        #[Assert\NotBlank]
        #[Exists(entity: AttributeEntity::class)]
        public int $attributeId,
        #[Groups(['value:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['value:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
