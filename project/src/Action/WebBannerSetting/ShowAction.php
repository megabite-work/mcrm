<?php

namespace App\Action\WebBannerSetting;

use App\Dto\WebBannerSetting\IndexDto;
use App\Repository\WebBannerSettingRepository;

class ShowAction
{
    public function __construct(
        private WebBannerSettingRepository $repo
    ) {}

    public function __invoke(int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->find($id));
    }
}
