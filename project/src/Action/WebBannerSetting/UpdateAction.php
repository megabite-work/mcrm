<?php

namespace App\Action\WebBannerSetting;

use App\Component\EntityNotFoundException;
use App\Dto\WebBannerSetting\RequestDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): array
    {
        $entity = $this->em->getRepository(WebBannerSetting::class)->findOneBy(['id' => $id])
            ?? throw new EntityNotFoundException('web banner setting not found', 404);

        $webBannerIds = array_map(function (int $id) {
            return $this->em->getReference(WebBanner::class, $id)->getId();
        }, $dto->webBannerIds) ?: throw new EntityNotFoundException('web banner not found', 404);

        $entity->setAnimation($dto->animation ?? $entity->getAnimation())
            ->setWebBannerIds($webBannerIds ?? $entity->getWebBannerIds())
            ->setMove($dto->move ?? $entity->getMove())
            ->setDelay($dto->delay ?? $entity->getDelay())
            ->setSpeed($dto->speed ?? $entity->getSpeed());
        $this->em->persist($entity);
        $this->em->flush();

        return [];
    }
}
