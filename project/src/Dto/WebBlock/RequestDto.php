<?php

namespace App\Dto\WebBlock;

use App\Entity\WebBlock;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_block:create'])]
        #[Assert\NotBlank(groups: ['web_block:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        #[Assert\Choice(choices: [WebBlock::TYPE_BANNER, WebBlock::TYPE_EVENT], groups: ['web_block:create', 'web_block:update'])]
        public string $type,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        public string $title,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'], allowNull: true)]
        public ?int $typeId = null,
        #[Groups(['web_block:create', 'web_block:update'])]
        #[Assert\NotBlank(groups: ['web_block:create', 'web_block:update'])]
        public bool $isActive = false,
    ) {}
}
