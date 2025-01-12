<?php

namespace App\Action\WebBanner;

use App\Component\Paginator;
use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\WebBanner\IndexDto;
use App\Dto\WebBanner\RequestQueryDto;
use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Repository\WebBannerRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private WebBannerRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        $paginator = $this->repo->findAllWebBannersByMultiStore($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromEntity($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }

    private function getWebBannerByType(WebBanner $webBanner, string $type, int $id): void
    {
        if ('product' === $type) {
            $title = $this->em->find(WebNomenclature::class, $id)?->getTitle();
        } elseif ('category' === $type) {
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
