<?php

namespace App\Repository;

use App\Entity\CounterPart;
use App\Component\Paginator;
use App\Dto\CounterPart\RequestQueryDto;
use App\Entity\MultiStore;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<CounterPart>
 */
class CounterPartRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CounterPart::class);
    }

    public function findAllCounterPartsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\CounterPart c
            WHERE c.multiStore = :multiStore'
        )->setParameter('multiStore', $multiStore);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findCounterPartWithAddressAndPhonesById(int $id): ?CounterPart
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, a, p
            FROM App\Entity\CounterPart c
            LEFT JOIN c.address a
            LEFT JOIN c.phones p
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
