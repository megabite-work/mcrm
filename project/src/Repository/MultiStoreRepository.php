<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\MultiStore;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MultiStore>
 */
class MultiStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiStore::class);
    }

    public function findAllMultiStoresByOwner(User $owner, int $page = 1): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, a, p, s
            FROM App\Entity\MultiStore m
            LEFT JOIN m.address a
            LEFT JOIN m.phones p
            LEFT JOIN m.stores s
            WHERE m.owner = :owner'
        )->setParameter('owner', $owner);

        return new Paginator($query, $page);
    }

    public function getMultiStoreById(int $multiStoreId): ?MultiStore
    {
        return $this->find($multiStoreId);
    }
}
