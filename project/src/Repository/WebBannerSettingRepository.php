<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebBannerSetting\RequestQueryDto;
use App\Entity\WebBannerSetting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebBannerSetting>
 */
class WebBannerSettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebBannerSetting::class);
    }

    public function findAllWebBannerSettingsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wbs
            FROM App\Entity\WebBannerSetting wbs
            WHERE wbs.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->multiStoreId]);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
