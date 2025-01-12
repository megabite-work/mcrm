<?php

namespace App\Action\WebBanner;

use App\Dto\WebBanner\IndexDto;
use App\Dto\WebBanner\RequestDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebBannerRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $multiStore = $this->em->getReference(MultiStore::class, $dto->multiStoreId);
        $typeId = is_numeric($dto->typeId) ? intval($dto->typeId) : $dto->typeId;
        $entity = (new WebBanner())
            ->setType($dto->type)
            ->setTypeId($typeId)
            ->setImage($dto->image)
            ->setTitle($dto->title)
            ->setDescription($dto->description)
            ->setDevices($dto->devices)
            ->setClickType($dto->clickType)
            ->setClickMax($dto->clickMax)
            ->setClickCurrent($dto->clickCurrent)
            ->setViewType($dto->viewType)
            ->setViewMax($dto->viewMax)
            ->setViewCurrent($dto->viewCurrent)
            ->setBeginAt($dto->beginAt)
            ->setEndAt($dto->endAt)
            ->setMultiStore($multiStore);
        $this->em->persist($entity);
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
