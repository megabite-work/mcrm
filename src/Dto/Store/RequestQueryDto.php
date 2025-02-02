<?php

namespace App\Dto\Store;

use App\Component\Paginator;
use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['store:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(MultiStore::class)]
        public int $multiStoreId,
        #[Groups(['store:index', 'store:nomenclatures'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['store:index', 'store:nomenclatures'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
