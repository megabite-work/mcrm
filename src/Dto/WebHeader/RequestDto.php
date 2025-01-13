<?php

namespace App\Dto\WebHeader;

use App\Entity\MultiStore;
use App\Entity\WebHeader;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_header:create'])]
        #[Assert\NotBlank(groups: ['web_header:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_header:create', 'web_header:update'])]
        #[Assert\NotBlank(groups: ['web_header:create', 'web_header:update'])]
        #[Assert\Choice(choices: [WebHeader::TYPE_ABOUT, WebHeader::TYPE_LOGO, WebHeader::TYPE_CATEGORY, WebHeader::TYPE_SOCIAL], groups: ['web_header:create', 'web_header:update'])]
        public string $type,
        #[Groups(['web_header:create', 'web_header:update'])]
        #[Assert\NotBlank(groups: ['web_header:create', 'web_header:update'])]
        public bool $isActive = false,
    ) {}
}
