<?php

namespace App\Dto\CashboxShift;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['cashbox_shift:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        private int $cashboxId,
        #[Groups(['cashbox_shift:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['cashbox_shift:index'])]
        #[Assert\Positive]
        private int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getCashboxId(): int
    {
        return $this->cashboxId;
    }
}
