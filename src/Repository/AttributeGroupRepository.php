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
        $dql = 'SELECT ag 
            FROM App\Entity\AttributeGroup ag';

        if ($dto->isFull) {
            $dql = 'SELECT ag, ae, av, v 
                FROM App\Entity\AttributeGroup ag 
                LEFT JOIN ag.attributeEntities ae 
                LEFT JOIN ae.attributeValues av 
                LEFT JOIN av.value v';
        }

        $query = $this->getEntityManager()->createQuery($dql);

        return new Paginator($query, $dto->page, $dto->perPage);
    }
}
