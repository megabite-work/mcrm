<?php

namespace App\Action\WebBanner;

use App\Dto\WebBanner\IndexDto;
use App\Dto\WebBanner\RequestDto;
use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $id, RequestDto $dto): IndexDto
    {
        $entity = $this->em->find(WebBanner::class, $id);
        $typeId = is_numeric($dto->typeId) ? intval($dto->typeId) : $dto->typeId;
        $entity->setType($dto->type ?? $entity->getType())
            ->setTypeId($typeId ?? $entity->getTypeId())
            ->setShowType($dto->showType ?? $entity->getShowType())
            ->setShowTypeId($dto->showTypeId ?? $entity->getShowTypeId())
            ->setImage($dto->image ?? $entity->getImage())
            ->setTitle($dto->title ?? $entity->getTitle())
            ->setDescription($dto->description ?? $entity->getDescription())
            ->setDevices($dto->devices ?? $entity->getDevices())
            ->setClickType($dto->clickType ?? $entity->getClickType())
            ->setClickMax($dto->clickMax ?? $entity->getClickMax())
            ->setClickCurrent($dto->clickCurrent ?? $entity->getClickCurrent())
            ->setViewType($dto->viewType ?? $entity->getViewType())
            ->setViewMax($dto->viewMax ?? $entity->getViewMax())
            ->setViewCurrent($dto->viewCurrent ?? $entity->getViewCurrent())
            ->setBeginAt($dto->beginAt ?? $entity->getBeginAt())
            ->setIsActive($dto->isActive ?? $entity->getIsActive())
            ->setEndAt($dto->endAt);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function getWebBannerByType(WebBanner $webBanner, string $type, int $id): WebBanner
    {
        if ($type === 'product') {
            $title = $this->em->find(WebNomenclature::class, $id)?->getTitle();
        } else if ($type === 'category') {
            $title = $this->em->find(Category::class, $id)?->getName()['ru'];
        }

        $webBanner->setTitle($title);

        return $webBanner;
    }
}
