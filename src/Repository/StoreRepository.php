<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Store\RequestQueryDto;
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

    public function findAllStoresByMultiStore(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $multiStore = $this->em->getReference(MultiStore::class, $dto->multiStoreId);

        $query = $em->createQuery(
            'SELECT s
            FROM App\Entity\Store s
            WHERE s.multiStore = :multiStore'
        )->setParameter('multiStore', $multiStore);

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findStoreByIdWithAddressAndPhonesAndWorkers(int $id): ?Store
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT s, a, p, w
            FROM App\Entity\Store s
            LEFT JOIN s.workers w
            LEFT JOIN s.address a
            LEFT JOIN s.phones p
            WHERE s.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findStoreByIdWithAddressAndPhones(int $id): ?Store
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT s, a, p
            FROM App\Entity\Store s
            LEFT JOIN s.address a
            LEFT JOIN s.phones p
            WHERE s.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
