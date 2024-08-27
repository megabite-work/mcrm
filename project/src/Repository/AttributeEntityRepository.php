<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\AttributeEntity;
use App\Dto\Attribute\RequestQueryDto;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<AttributeEntity>
 */
class AttributeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeEntity::class);
    }

    public function findAllAttributesByCategory(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT a
            FROM App\Entity\AttributeEntity a
            JOIN a.categories c
            WHERE c.id = :cid'
        )->setParameter('cid', $dto->getCategoryId());

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
