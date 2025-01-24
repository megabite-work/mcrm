<?php

namespace App\Action\WebBlock;

use App\Entity\WebBannerSetting;
use App\Entity\WebBlock;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebBlock::class, $id);
        if ($entity->getType() === WebBlock::TYPE_BANNER) {
            $bannerSetting = $this->em->getRepository(WebBannerSetting::class)->findOneby(['id' => $entity->getTypeId()]);
            $this->em->remove($bannerSetting);
        }
        
        $this->em->remove($entity);
        $this->em->flush();
    }
}
