<?php

namespace App\Action\WebBanner;

use App\Entity\Category;
use App\Entity\WebBanner;
use App\Component\Paginator;
use App\Entity\WebNomenclature;
use App\Dto\WebBanner\RequestQueryDto;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private WebBannerRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        $entities = $this->repo->findAllWebBannersByMultiStore($dto);

        return $this->setTitle($entities);
    }

    private function getWebBannerByType(WebBanner $webBanner, string $type, int $id): void
    {
        if ($type === 'product') {
            $title = $this->em->find(WebNomenclature::class, $id)?->getTitle();
        } else if ($type === 'category') {
            $title = $this->em->find(Category::class, $id)?->getName()['ru'];
        }

        $webBanner->setTitle($title);
    }

    private function setTitle(Paginator $entities): Paginator
    {
        foreach ($entities->getData() as $webBanner) {
            $this->getWebBannerByType($webBanner, $webBanner->getType(), $webBanner->getTypeId());
        }

        return $entities;
    }
}
