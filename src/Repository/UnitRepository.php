<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Unit\RequestQueryDto;
use App\Entity\Unit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Unit>
 */
class UnitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Unit::class);
    }

    public function findAllUnits(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT u
            FROM App\Entity\Unit u'
        );

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findUnitById(int $id): ?Unit
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT u
            FROM App\Entity\Unit u
            WHERE u.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
