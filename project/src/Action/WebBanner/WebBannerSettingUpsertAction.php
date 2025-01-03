<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\WebBannerSettingUpsertDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerSettingUpsertAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, WebBannerSettingUpsertDto $dto): array
    {
        $webBannerSetting = $this->em->getRepository(WebBannerSetting::class)->findOneBy(['id' => $id])
            ?? throw new EntityNotFoundException('web banner setting not found', 404);

        $webBannerIds = array_map(function (int $id) {
            return $this->em->getReference(WebBanner::class, $id)->getId();
        }, $dto->webBannerIds) ?: throw new EntityNotFoundException('web banner not found', 404);

        $webBannerSetting->setTitle($dto->title)
            ->setAnimation($dto->animation)
            ->setWebBannerIds($webBannerIds)
            ->setMove($dto->move)
            ->setDelay($dto->delay)
            ->setSpeed($dto->speed);
        $this->em->persist($webBannerSetting);
        $this->em->flush();

        return [];
    }
}
