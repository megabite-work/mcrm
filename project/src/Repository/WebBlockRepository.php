<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebBlock\RequestQueryDto;
use App\Entity\WebBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WebBlock>
 */
class WebBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebBlock::class);
    }

    public function findAllWebBloksByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wb
            FROM App\Entity\WebBlock wb
            WHERE wb.multiStoreId = :multiStoreId'
        )->setParameters(['multiStoreId' => $dto->multiStoreId]);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function getLatestOrder(int $multiStoreId): mixed
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT wb.order
            FROM App\Entity\WebBlock wb
            WHERE wb.multiStoreId = :multiStoreId
            ORDER BY wb.order DESC'
        )
            ->setParameters(['multiStoreId' => $multiStoreId])
            ->setMaxResults(1);
        try {
            return $query->getSingleScalarResult();
        } catch (NoResultException $e) {
            return 0;
        }
    }
}
