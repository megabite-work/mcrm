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
        $multiStore = $this->getEntityManager()
            ->getReference(MultiStore::class, $dto->multiStoreId);
        $query = $this->createQueryBuilder('wb')
            ->where('wb.multiStore = :multiStore')
            ->setParameter('multiStore', $multiStore);

        if (is_bool($dto->isActive)) {
            $query->andWhere('wb.isActive = :isActive')
                ->setParameter('isActive', $dto->isActive);
        }

        if (!empty($dto->title)) {
            $query->andWhere('wb.title LIKE :title')
                ->setParameter('title', '%' . $dto->title . '%');
        }

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findByOrder(array $ids = []): array
    {
        if (empty($ids)) {
            return [];
        }

        $conn = $this->getEntityManager()->getConnection();
        $sql = sprintf('SELECT * 
            FROM web_banner 
            WHERE id IN (%s)
            ORDER BY FIELD(id, %s)', implode(',', $ids), implode(',', $ids));

        return $conn->fetchAllAssociative($sql);
    }

    public function findWebBannerWithMultiStore(int $id): ?WebBanner
    {
        return $this->getEntityManager()->createQuery(
            'SELECT wb, m
            FROM App\Entity\WebBanner wb
            JOIN wb.multiStore m
            WHERE wb.id = :id'
        )
            ->setParameter('id', $id)
            ->getOneOrNullResult();
    }
}
