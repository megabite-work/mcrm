<?php

namespace App\Dto\WebFooter;

use App\Entity\WebFooter;
use App\Validator\Exists;
use Symfony\Component\Validator\Constraints as Assert;

final class SortDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(WebFooter::class)]
        public int $id,
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $order,
    ) {}
}
