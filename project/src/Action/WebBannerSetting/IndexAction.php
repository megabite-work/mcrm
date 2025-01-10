<?php

namespace App\Action\WebBannerSetting;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebBannerSetting\IndexDto;
use App\Dto\WebBannerSetting\RequestQueryDto;
use App\Repository\WebBannerSettingRepository;

class IndexAction
{
    public function __construct(
        private WebBannerSettingRepository $repo
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebBannerSettingsByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }
}
