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
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ag, ae, av
            FROM App\Entity\AttributeGroup ag
            LEFT JOIN App\Entity\AttributeEntity ae WITH ae.groupId = ag.id
            LEFT JOIN ae.attributeValues av
            JOIN av.value v'
        );

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
