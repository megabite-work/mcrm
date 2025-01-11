<?php

namespace App\Dto\WebFooter;

use App\Entity\MultiStore;
use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_footer:create'])]
        #[Assert\NotBlank(groups: ['web_footer:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        #[Assert\Choice(choices: [WebFooter::TYPE_ABOUT, WebFooter::TYPE_LINK, WebFooter::TYPE_CONTACT, WebFooter::TYPE_SOCIAL], groups: ['web_footer:create', 'web_footer:update'])]
        public string $type,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        public string $title,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        #[Assert\PositiveOrZero]
        public int $order = 0,
        #[Groups(['web_footer:create', 'web_footer:update'])]
        #[Assert\NotBlank(groups: ['web_footer:create', 'web_footer:update'])]
        public bool $isActive = true,
    ) {}
}
