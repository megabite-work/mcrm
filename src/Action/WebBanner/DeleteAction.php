<?php

namespace App\Action\WebBanner;

use App\Entity\WebBanner;
use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em
            ->getRepository(WebBanner::class)
            ->findWebBannerWithMultiStore($id);
        $this->cleanWebBannerIds($entity->getMultiStore()->getId(), $id);
        $this->em->remove($entity);
        $this->em->flush();
    }

    private function cleanWebBannerIds(int $multiStoreId, int $id): void
    {
        $webBannerSettings = $this->em
            ->getRepository(WebBannerSetting::class)
            ->findBy(['multiStoreId' => $multiStoreId]);

        foreach ($webBannerSettings as $webBannerSetting) {
            if (in_array($id, $webBannerSetting->getWebBannerIds())) {
                $webBannerSetting->setWebBannerIds(array_values(array_filter($webBannerSetting->getWebBannerIds(), fn($webBannerId) => $webBannerId != $id)));
                $this->em->persist($webBannerSetting);
            }
        }
    }
}
