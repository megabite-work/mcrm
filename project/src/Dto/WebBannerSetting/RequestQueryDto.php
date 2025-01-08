<?php

namespace App\Dto\WebBannerSetting;

use App\Component\Paginator;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestQueryDto
{
    public function __construct(
        #[Groups(['web_banner_setting:index'])]
        #[Assert\NotBlank]
        #[Assert\Positive]
        public int $multiStoreId,
        #[Groups(['web_banner_setting:index'])]
        #[Assert\Positive]
        public int $page = 1,
        #[Groups(['web_banner_setting:index'])]
        #[Assert\Positive]
        public int $perPage = Paginator::ITEMS_PER_PAGE
    ) {}
}
