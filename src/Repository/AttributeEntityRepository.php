<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Attribute\RequestQueryDto;
use App\Entity\AttributeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $qb = $this->createQueryBuilder('a');
        $query = $qb->select('a', 'p', 'ch')
            ->join('a.categories', 'c')
            ->where('c.id = :cid')
            ->setParameter('cid', $dto->categoryId);

        if ($dto->name) {
            $query->andWhere($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.ru')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.uz')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.uzc')", ':name')
            ))->setParameter('name', '%' . $dto->name . '%');
        }

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
