<?php

namespace App\Dto\WebFooterBody;

use App\Component\Paginator;
use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_event:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(WebFooter::class)]
        public int $webFooterId,
        #[Groups(['web_event:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['web_event:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
