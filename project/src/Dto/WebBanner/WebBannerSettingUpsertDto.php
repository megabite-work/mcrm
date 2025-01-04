<?php

namespace App\Dto\WebBanner;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class WebBannerSettingUpsertDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\All(constraints: [new Assert\Positive])]
        public array $webBannerIds,
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
