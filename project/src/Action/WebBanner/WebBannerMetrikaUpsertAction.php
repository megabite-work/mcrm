<?php

namespace App\Action\WebBanner;

use App\Component\EntityNotFoundException;
use App\Dto\WebBanner\WebBannerMetrikaUpsertDto;
use App\Entity\WebBanerMetrika;
use App\Entity\WebBanner;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerMetrikaUpsertAction
{
    public function __construct(private EntityManagerInterface $em) {}

    public function __invoke(WebBannerMetrikaUpsertDto $dto): void
    {
        $webBanner = $this->em->find(WebBanner::class, $dto->getWebBannerId())
            ?? throw new EntityNotFoundException('multi store not found', 404);

        $this->upsert($webBanner, $dto);
        $this->em->flush();
    }

    private function upsert(WebBanner $webBanner, WebBannerMetrikaUpsertDto $dto): void
    {
        $entity = $this->em
            ->getRepository(WebBanerMetrika::class)
            ->findOneBy(['webBanner' => $webBanner, 'ip' => $dto->getIp(), 'type' => $dto->getType()])
            ?? new WebBanerMetrika();

        $entity->setIp($dto->getIp())
            ->setType($dto->getType())
            ->setWebBanner($webBanner);
    }
}
