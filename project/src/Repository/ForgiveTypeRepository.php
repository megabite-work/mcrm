<?php

namespace App\Repository;

use App\Entity\ForgiveType;
use App\Component\Paginator;
use App\Dto\ForgiveType\RequestQueryDto;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ForgiveType>
 */
class ForgiveTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ForgiveType::class);
    }

    public function findAllForgiveTypes(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT f
            FROM App\Entity\ForgiveType f'
        );

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findForgiveTypeById(int $id): ?ForgiveType
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT f
            FROM App\Entity\ForgiveType f
            WHERE f.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
