<?php

namespace App\Repository;

use App\Entity\WebBanner;
use App\Component\Paginator;
use App\Dto\WebBanner\RequestQueryDto;
use App\Entity\MultiStore;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<WebBanner>
 */
class WebBannerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebBanner::class);
    }

    public function findAllWebBannersByMultiStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());

        $query = $entityManager->createQuery(
            'SELECT wb
            FROM App\Entity\WebBanner wb
            WHERE wb.multiStore = :multiStore'
        )->setParameters(['multiStore' => $multiStore]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
