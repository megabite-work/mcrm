<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\MultiStore;
use App\Component\Paginator;
use App\Dto\MultiStore\RequestQueryDto;
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

    public function findAllMultiStoresByOwnerWithPagination(User $owner, RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT m, s
            FROM App\Entity\MultiStore m
            LEFT JOIN m.stores s
            WHERE m.owner = :owner'
        )->setParameter('owner', $owner);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
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
