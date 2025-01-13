<?php

namespace App\Dto\WebView;

use App\Entity\MultiStore;
use App\Entity\WebView;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_view:create'])]
        #[Assert\NotBlank(groups: ['web_view:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_view:create', 'web_view:update'])]
        #[Assert\NotBlank(groups: ['web_view:create', 'web_view:update'])]
        #[Assert\Choice(choices: WebView::TYPES)]
        public string $type,
        #[Groups(['web_view:create', 'web_view:update'])]
        #[Assert\NotBlank(groups: ['web_view:create', 'web_view:update'])]
        public bool $isActive = false,
    ) {}
}
