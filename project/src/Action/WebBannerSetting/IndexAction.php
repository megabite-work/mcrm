<?php

namespace App\Action\WebBannerSetting;

use App\Component\Paginator;
use App\Dto\WebBannerSetting\RequestQueryDto;
use App\Repository\WebBannerSettingRepository;

class IndexAction
{
    public function __construct(
        private WebBannerSettingRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        return $this->repo->findAllWebBannerSettingsByMultiStore($dto);
    }
}
