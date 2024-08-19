<?php

namespace App\Repository;

use App\Entity\Cashbox;
use App\Component\Paginator;
use App\Dto\Cashbox\RequestQueryDto;
use App\Entity\Store;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Cashbox>
 */
class CashboxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cashbox::class);
    }

    public function findAllCashboxesByStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $dto->getStoreId());

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Cashbox c
            WHERE c.store = :store'
        )->setParameter('store', $store);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findCashboxById(int $id): ?Cashbox
    {
        return $this->find($id);
    }

    public function findCashboxByIdWithStore(int $id): ?Cashbox
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, s
            FROM App\Entity\Cashbox c
            JOIN c.store s
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function hasCashboxByNameAndStore(Store $store, string $name): bool
    {
        return null === $this->findOneBy(['name' => $name, 'store' => $store]);
    }
}
