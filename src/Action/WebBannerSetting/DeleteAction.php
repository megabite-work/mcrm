<?php

namespace App\Action\WebBannerSetting;

use App\Entity\WebBannerSetting;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): void
    {
        $entity = $this->em->find(WebBannerSetting::class, $id);
        $this->em->remove($entity);
        $this->em->flush();
    }
}
