<?php

namespace App\Action\WebBannerSetting;

use App\Dto\WebBannerSetting\IndexDto;
use App\Dto\WebBannerSetting\RequestDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->getRepository(WebBannerSetting::class)->findOneBy(['id' => $id]);
        $webBannerIds = array_map(function (int $id) {
            return $this->em->getReference(WebBanner::class, $id)->getId();
        }, $dto->webBannerIds);
        $entity->setAnimation($dto->animation ?? $entity->getAnimation())
            ->setWebBannerIds($webBannerIds)
            ->setMove($dto->move ?? $entity->getMove())
            ->setDelay($dto->delay ?? $entity->getDelay())
            ->setSpeed($dto->speed ?? $entity->getSpeed());
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
