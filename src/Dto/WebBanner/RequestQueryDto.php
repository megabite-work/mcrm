<?php

namespace App\Dto\WebBanner;

use App\Component\Paginator;
use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_banner:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        #[Exists(MultiStore::class)]
        public int $multiStoreId,
        #[Groups(['web_banner:index'])]
        #[Assert\Type(type: ['bool', 'null'])]
        public ?bool $isActive = null,
        #[Groups(['web_banner:index'])]
        #[Assert\Type(type: ['string', 'null'])]
        public ?string $title = null,
        #[Groups(['web_banner:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['web_banner:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
