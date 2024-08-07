<?php

namespace App\Dto\Category;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['category:index'])]
        #[Assert\NotBlank(allowNull: true)]
        #[Assert\Type(type: ['integer', 'null'])]
        private ?int $parentId = null,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['category:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }
}
