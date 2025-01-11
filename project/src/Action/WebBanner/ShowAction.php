<?php

namespace App\Action\WebBanner;

use App\Dto\WebBanner\IndexDto;
use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class ShowAction
{
    public function __construct(
        private WebBannerRepository $repo,
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): IndexDto
    {
         return IndexDto::fromEntity($this->repo->find($id));
    }

    private function getWebBannerByType(WebBanner $webBanner, string $type, int $id): WebBanner
    {
        if ('product' === $type) {
            $title = $this->em->find(WebNomenclature::class, $id)?->getTitle();
        } elseif ('category' === $type) {
            $title = $this->em->find(Category::class, $id)?->getName()['ru'];
        }

        $webBanner->setTitle($title);

        return $webBanner;
    }
}
