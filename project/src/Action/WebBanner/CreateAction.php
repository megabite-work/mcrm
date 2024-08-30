<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\RequestDto;
use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\MultiStore;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private WebBannerRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): WebBanner
    {
        $multiStore = $this->em->find(MultiStore::class, $dto->getMultiStoreId());

        if (null === $multiStore) {
            throw new EntityNotFoundException('multi store not found', 404);
        }

        $entity = $this->create($multiStore, $dto);

        $this->em->flush();

        return $this->getWebBannerByType($entity, $dto->getType(), $dto->getTypeId());
    }

    private function create(MultiStore $multiStore, RequestDto $dto): WebBanner
    {
        $entity = (new WebBanner())
            ->setType($dto->getType())
            ->setTypeId($dto->getTypeId())
            ->setimage($dto->getimage())
            ->setMultiStore($multiStore);

        $this->em->persist($entity);

        return $entity;
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
