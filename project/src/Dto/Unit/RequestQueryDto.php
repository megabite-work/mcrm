<?php

namespace App\Dto\Unit;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['unit:index'])]
        #[Assert\Positive(message: 'This value should be positive')]
        public ?int $page = 1,
        #[Groups(['unit:index'])]
        #[Assert\Positive(message: 'This value should be positive')]
        public ?int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
