<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\AttributeGroup\RequestQueryDto;
use App\Entity\AttributeGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributeGroup>
 */
class AttributeGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeGroup::class);
    }

    public function findAllAttributeGroups(RequestQueryDto $dto): Paginator
    {
        $qb = $this->createQueryBuilder('ag');
        $query = $qb->select('ag');

        if ($dto->isFull) {
            $query->addSelect('ae', 'av', 'v')->leftJoin('ag.attributeEntities', 'ae')
                ->leftJoin('ae.attributeValues', 'av')
                ->leftJoin('av.value', 'v');

            if ($dto->name) {
                $query->andWhere($qb->expr()->orX(
                    $qb->expr()->like("JSON_EXTRACT(ae.name, '$.ru')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(ae.name, '$.uz')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(ae.name, '$.uzc')", ':name')
                ))->setParameter('name', '%' . $dto->name . '%');
            }
        } else {
            if ($dto->name) {
                $query->andWhere($qb->expr()->orX(
                    $qb->expr()->like("JSON_EXTRACT(ag.name, '$.ru')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(ag.name, '$.uz')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(ag.name, '$.uzc')", ':name')
                ))->setParameter('name', '%' . $dto->name . '%');
            }
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }
}
