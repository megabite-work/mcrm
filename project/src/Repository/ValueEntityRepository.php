<?php

namespace App\Repository;

use App\Entity\ValueEntity;
use App\Component\Paginator;
use App\Dto\Value\RequestQueryDto;
use App\Entity\AttributeEntity;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ValueEntity>
 */
class ValueEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValueEntity::class);
    }

    public function findAllValuesByAttribute(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $attribute = $entityManager->find(AttributeEntity::class, $dto->getAttributeId());

        $query = $entityManager->createQuery(
            'SELECT av, v
            FROM App\Entity\AttributeValue av
            LEFT JOIN av.value v
            WHERE av.attribute = :attribute'
        )->setParameter('attribute', $attribute);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
