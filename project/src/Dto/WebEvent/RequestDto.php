<?php

namespace App\Dto\WebEvent;

use App\Entity\MultiStore;
use App\Entity\WebEvent;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_event:create'])]
        #[Assert\NotBlank(groups: ['web_event:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\Choice(choices: [WebEvent::TYPE_CATEGORY, WebEvent::TYPE_PRODUCT], groups: ['web_event:create', 'web_event:update'])]
        public string $type,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        public array $typeIds,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        public string $title,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        public string $animation,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\Choice(choices: ['up', 'right', 'left', 'down'])]
        public string $move,
        #[Groups(['web_event:create', 'web_event:update'])]
        #[Assert\NotBlank(groups: ['web_event:create', 'web_event:update'])]
        #[Assert\PositiveOrZero]
        public int $delay = 0,
    ) {}
}
