<?php

namespace App\Dto\WebFooterBody;

use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer_body:create', 'web_footer_body:update'])]
        #[Assert\NotBlank(groups: ['web_footer_body:create', 'web_footer_body:update'])]
        #[Exists(WebFooter::class)]
        public int $webFooterId,
    ) {
    }
}
