<?php

namespace App\Repository;

use App\Entity\MultiStore;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<MultiStore>
 */
class MultiStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MultiStore::class);
    }

    public function findAllMultiStoresByOwner(User $owner): ?array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m
            FROM App\Entity\MultiStore m
            WHERE m.owner = :owner'
        )->setParameter('owner', $owner);

        return $query->getResult();
    }

    public function getMultiStoreById(int $multiStoreId): ?MultiStore
    {
        return $this->find($multiStoreId);
    }
}
