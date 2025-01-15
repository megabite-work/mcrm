<?php

namespace App\Dto\WebFooterLink;

use App\Component\Paginator;
use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_footer_link:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(WebFooter::class)]
        public int $webFooterId,
        #[Groups(['web_footer_link:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['web_footer_link:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
