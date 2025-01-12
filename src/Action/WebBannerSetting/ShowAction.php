<?php

namespace App\Action\WebBannerSetting;

use App\Dto\WebBannerSetting\IndexDto;
use App\Dto\WebBanner\IndexDto as WebBannerDto;
use App\Repository\WebBannerRepository;
use App\Repository\WebBannerSettingRepository;

class ShowAction
{
    public function __construct(
        private WebBannerSettingRepository $repo,
        private WebBannerRepository $webBannerRepository,
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $entity = $this->repo->find($id);
        $webBanners = array_map(function ($webBanner): WebBannerDto {
            return WebBannerDto::fromEntity($webBanner);
        }, $this->webBannerRepository->findBy(['id' => $entity->getWebBannerIds()]));

        return IndexDto::fromEntity($entity, $webBanners);
    }
}
