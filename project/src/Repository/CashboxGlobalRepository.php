<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\CashboxDetail;
use App\Entity\CashboxGlobal;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\CashboxGlobal\RequestQueryDto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<CashboxGlobal>
 */
class CashboxGlobalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CashboxGlobal::class);
    }

    public function findAllCashboxGlobalsByCashboxDetail(RequestQueryDto $dto): Paginator
    {
        $qb = $this->getEntityManager();
        $cashboxDetail = $qb->find(CashboxDetail::class, $dto->getCashboxDetailId());

        $query = $qb->createQuery(
            'SELECT cg, n
            FROM App\Entity\CashboxGlobal cg
            JOIN cg.nomenclature n
            WHERE cg.cashboxDetail = :cashboxDetail'
        )->setParameters(['cashboxDetail' => $cashboxDetail]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findCashboxGlobalById(int $id): ?CashboxGlobal
    {
        $qb = $this->getEntityManager();

        $query = $qb->createQuery(
            'SELECT cg, n
            FROM App\Entity\CashboxGlobal cg
            JOIN cg.nomenclature n
            WHERE cg.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getOneOrNullResult();
    }
}
