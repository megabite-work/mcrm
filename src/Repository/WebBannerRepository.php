<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebBanner\RequestQueryDto;
use App\Entity\MultiStore;
use App\Entity\WebBanner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $em = $this->getEntityManager();
        $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);

        $dql = sprintf('SELECT wb
            FROM App\Entity\WebBanner wb
            WHERE wb.multiStore = :multiStore%s', is_bool($dto->isActive) ? ' AND wb.isActive = :isActive' : '');
        $query = $em->createQuery($dql)->setParameter('multiStore', $multiStore);

        if (is_bool($dto->isActive)) {
            $query->setParameter('isActive', $dto->isActive);
        }

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findByOrder(array $ids = []): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = sprintf('SELECT * 
            FROM web_banner 
            WHERE id IN (%s)
            ORDER BY FIELD(id, %s)', implode(',', $ids), implode(',', $ids));

        return $conn->fetchAllAssociative($sql);
    }
}
