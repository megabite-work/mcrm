<?php

namespace App\Action\WebBanner;

use App\Dto\WebBanner\WebBannerMetrikaUpsertDto;
use App\Entity\WebBanner;
use App\Entity\WebBannerMetrika;
use Doctrine\ORM\EntityManagerInterface;

class WebBannerMetrikaUpsertAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, WebBannerMetrikaUpsertDto $dto): void
    {
        $webBanner = $this->em->getRepository(WebBanner::class)->findOneBy(['id' => $id, 'isActive' => true]);
        $this->upsert($webBanner, $dto);
        $this->em->flush();
    }

    private function upsert(WebBanner $webBanner, WebBannerMetrikaUpsertDto $dto): void
    {
        $methodType = 'get' . ucfirst($dto->type) . 'Type';
        $methodMax = 'get' . ucfirst($dto->type) . 'Max';
        $methodCurrent = 'get' . ucfirst($dto->type) . 'Current';
        $webBannerMetrika = $this->em->getRepository(WebBannerMetrika::class)->findOneBy(['webBanner' => $webBanner, 'ip' => $dto->ip, 'type' => $dto->type]);

        match (true) {
            $webBanner->$methodType() === WebBanner::UNIQUE && $webBannerMetrika === null => $this->handle($webBanner, new WebBannerMetrika(), $dto, $methodMax, $methodCurrent),
            $webBanner->$methodType() === WebBanner::ALL => $this->handle($webBanner, $webBannerMetrika ?? new WebBannerMetrika(), $dto, $methodMax, $methodCurrent),
            default => null,
        };
    }

    private function handle(WebBanner $webBanner, WebBannerMetrika $webBannerMetrika, WebBannerMetrikaUpsertDto $dto, string $methodMax, string $methodCurrent)
    {
        $webBannerMetrika->setIp($dto->ip)
            ->setType($dto->type)
            ->setWebBanner($webBanner);

        $this->em->persist($webBannerMetrika);

        $max = $webBanner->$methodMax();
        $current = $webBanner->$methodCurrent() + 1;
        $setMethodCurrent = 'set' . ucfirst($dto->type) . 'Current';

        if ($current < $max) {
            $webBanner->$setMethodCurrent($current);
        } else {
            $webBanner->$setMethodCurrent($current);
            $webBanner->setIsActive(false);
        }
    }
}
