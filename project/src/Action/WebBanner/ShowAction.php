<?php

namespace App\Action\WebBanner;

use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class ShowAction
{
    public function __construct(
        private WebBannerRepository $repo,
        private EntityManagerInterface $em
        )
    {
    }

    public function __invoke(int $id): WebBanner
    {
        $entity = $this->repo->find($id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        return $this->getWebBannerByType($entity, $entity->getType(), $entity->getTypeId());
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
