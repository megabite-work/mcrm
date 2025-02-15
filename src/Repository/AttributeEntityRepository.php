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
        $query = $qb->select('a', 'g')
            ->join('a.group', 'g');

        if ($dto->name) {
            $query->andWhere($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.ru')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.uz')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(a.name, '$.uzc')", ':name')
            ))->setParameter('name', '%' . $dto->name . '%');
        }

        if ($dto->categoryId) {
            $query->join('a.categories', 'c')
                ->andWhere('c.id = :cid')
                ->setParameter('cid', $dto->categoryId);
        }
        if ($dto->groupId) {
            $query->andWhere('g.id = :gid')
                ->setParameter('gid', $dto->groupId);
        }

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }

    public function findWithAttributeGroup(int $id): ?AttributeEntity
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT ae, ag
            FROM App\Entity\AttributeEntity ae
            LEFT JOIN ae.group ag
            WHERE ae.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
