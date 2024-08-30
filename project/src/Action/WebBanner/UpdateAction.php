<?php

namespace App\Action\WebBanner;

use App\Entity\Category;
use App\Entity\WebBanner;
use App\Entity\WebNomenclature;
use App\Dto\WebBanner\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(int $id, RequestDto $dto): WebBanner
    {
        $entity = $this->em->find(WebBanner::class, $id);

        if (null === $entity) {
            throw new EntityNotFoundException('not found');
        }

        $entity = $this->update($entity, $dto);

        $this->em->flush();

        return $this->getWebBannerByType($entity, $entity->getType(), $entity->getTypeId());
    }

    private function update(WebBanner $entity, RequestDto $dto)
    {
        if (null !== $dto->getIsActive()) {
            $entity->setIsActive($dto->getIsActive());
        }
        if ($dto->getType()) {
            $entity->setType($dto->getType());
        }
        if ($dto->getTypeId()) {
            $entity->setTypeId($dto->getTypeId());
        }
        if ($dto->getImage()) {
            $entity->setImage($dto->getImage());
        }

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
