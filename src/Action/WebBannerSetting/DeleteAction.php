<?php

namespace App\Action\WebBannerSetting;

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
        $entity = $this->em->find(WebBannerSetting::class, $id);
        $block = $this->em->getRepository(WebBlock::class)->findOneby(['typeId'=> $id, 'type' => WebBlock::TYPE_BANNER]);
        $this->em->remove($entity);
        $this->em->remove($block);
        $this->em->flush();
    }
}
