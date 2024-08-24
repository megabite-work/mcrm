<?php

namespace App\Action\WebBanner;

use App\Component\Paginator;
use App\Dto\WebBanner\RequestQueryDto;
use App\Repository\WebBannerRepository;

class IndexAction
{
    public function __construct(
        private WebBannerRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $entities = $this->repo->findAllWebBannersByMultiStore($dto);

        return $entities;
    }
}
