<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\NomenclatureHistory\RequestQueryDto;
use App\Entity\NomenclatureHistory;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomenclatureHistory>
 */
class NomenclatureHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NomenclatureHistory::class);
    }

    public function findAllNomenclatureHistoriesWithAllJoines(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $dto->storeId);
        $query = $em->createQuery(
            'SELECT nh, s, n, c, u, f, o
            FROM App\Entity\NomenclatureHistory nh
            JOIN nh.store s
            JOIN nh.nomenclature n
            LEFT JOIN nh.forgiveType f
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.provider f
            JOIN nh.owner o
            WHERE nh.store = :store'
        )->setParameter('store', $store);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findNomenclatureHistoryById(int $id): ?NomenclatureHistory
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT nh, s, n, c, u, f, o
            FROM App\Entity\NomenclatureHistory nh
            JOIN nh.store s
            JOIN nh.nomenclature n
            LEFT JOIN nh.forgiveType f
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.provider f
            JOIN nh.owner o
            WHERE nh.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
