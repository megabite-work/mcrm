<?php

namespace App\Dto\Attribute;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['attribute:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        private int $categoryId,
        #[Groups(['attribute:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['attribute:index'])]
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

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
