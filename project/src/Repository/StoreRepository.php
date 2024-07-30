<?php

namespace App\Repository;

use App\Entity\MultiStore;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Store>
 */
class StoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Store::class);
    }

    public function findAllStoresByMultiStore(MultiStore $multiStore): ?array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT s
            FROM App\Entity\Store s
            WHERE s.multiStore = :multiStore'
        )->setParameter('multiStore', $multiStore);

        return $query->getResult();
    }
}
