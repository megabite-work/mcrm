<?php

namespace App\Dto\WebBlock;

use App\Entity\WebBlock;
use App\Validator\Exists;
use Symfony\Component\Validator\Constraints as Assert;

final class SortDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(WebBlock::class)]
        public int $id,
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $order,
    ) {}
}
