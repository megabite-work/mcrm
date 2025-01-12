<?php

namespace App\Dto\PaymentType;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['payment_type:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['payment_type:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
