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
            'SELECT a
            FROM App\Entity\AttributeGroup a'
        );

        return new Paginator($query, $dto->page, $dto->perPage, false);
    }
}
