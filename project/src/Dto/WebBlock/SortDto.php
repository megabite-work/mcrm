<?php

namespace App\Dto\WebBlock;

use Symfony\Component\Validator\Constraints as Assert;

final class SortDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $id,
        #[Assert\NotBlank]
        #[Assert\PositiveOrZero]
        public int $order,
    ) {}
}
