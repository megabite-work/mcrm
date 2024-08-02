<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\MultiStore;
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

    public function findAllMultiStoresByOwnerWithPagination($owner, int $page, int $perPage): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, s
            FROM App\Entity\MultiStore m
            LEFT JOIN m.stores s
            WHERE m.owner = :owner'
        )->setParameter('owner', $owner);

        return new Paginator($query, $page, $perPage, false);
    }

    public function findMultiStoreByIdWithAddressAndPhoneAndStore(int $id): ?MultiStore
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, a, p, s
            FROM App\Entity\MultiStore m
            LEFT JOIN m.stores s
            LEFT JOIN m.address a
            LEFT JOIN m.phones p
            WHERE m.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findMultiStoreByIdWithAddressAndPhones(int $id): ?MultiStore
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, a, p
            FROM App\Entity\MultiStore m
            LEFT JOIN m.address a
            LEFT JOIN m.phones p
            WHERE m.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
