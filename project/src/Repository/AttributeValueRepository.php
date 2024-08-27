<?php

namespace App\Repository;

use App\Entity\AttributeValue;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<AttributeValue>
 */
class AttributeValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeValue::class);
    }

    public function findAllByItem(array $ids): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT av
            FROM App\Entity\AttributeValue a
            WHERE a.id IN :ids'
        )->setParameter('ids', $ids);

        return $query->getResult();
    }
}
