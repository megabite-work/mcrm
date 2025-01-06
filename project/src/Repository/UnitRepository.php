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
<<<<<<< HEAD
        $em = $this->getEntityManager();

        $query = $em->createQuery(
=======
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
            'SELECT u
            FROM App\Entity\Unit u'
        );

<<<<<<< HEAD
        return new Paginator($query, $dto->page, $dto->perPage, false);
=======
        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }

    public function findUnitById(int $id): ?Unit
    {
<<<<<<< HEAD
        $em = $this->getEntityManager();
        $query = $em->createQuery(
=======
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
            'SELECT u
            FROM App\Entity\Unit u
            WHERE u.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
