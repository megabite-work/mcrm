<?php

namespace App\Repository;

use App\Entity\Permission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\Permission\RequestQueryDto;
use App\Component\Paginator;

/**
 * @extends ServiceEntityRepository<Permission>
 */
class PermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Permission::class);
    }

    public function findAllPermissions(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Permission p'
        );

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }
}
