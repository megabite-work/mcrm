<?php

namespace App\Dto\Store;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['store:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        private int $multiStoreId,
        #[Groups(['store:index'])]
        #[Assert\Positive]
        private int $page = 1,
        #[Groups(['store:index'])]
        #[Assert\Positive]
        private int $perPage = 10
    ) {
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getMultiStoreId(): int
    {
        return $this->multiStoreId;
    }
}
