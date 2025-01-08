<?php

namespace App\Action\WebBannerSetting;

use App\Component\EntityNotFoundException;
use App\Entity\WebBannerSetting;
use App\Repository\WebBannerSettingRepository;

class ShowAction
{
    public function __construct(
        private WebBannerSettingRepository $repo
    ) {}

    public function __invoke(int $id): WebBannerSetting
    {
        return $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
    }
}
