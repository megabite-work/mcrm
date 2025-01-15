<?php

namespace App\Dto\WebFooterLink;

use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        #[Exists(WebFooter::class)]
        public int $webFooterId,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        public string $type,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        public string $title,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        public string $link,
        #[Groups(['web_footer_link:create', 'web_footer_link:update'])]
        #[Assert\NotBlank(groups: ['web_footer_link:create', 'web_footer_link:update'])]
        public bool $isActive = true,
    ) {}
}
