<?php

namespace App\Dto\WebBannerSetting;

use App\Entity\WebBanner;
use App\Validator\Exists;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class RequestDto
{
    public function __construct(
        #[Assert\All(constraints: [new Exists(WebBanner::class)])]
        public ?array $webBannerIds = [],
        #[Assert\NotBlank]
        public ?string $animation = null,
        #[Assert\NotBlank]
        #[Assert\Choice(choices: ['up', 'right', 'left', 'down'])]
        public ?string $move = null,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        public int $delay = 0,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        public int $speed = 0,
    ) {}
}
