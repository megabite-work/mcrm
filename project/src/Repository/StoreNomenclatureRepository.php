<?php

namespace App\Repository;

use App\Entity\StoreNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StoreNomenclature>
 */
class StoreNomenclatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoreNomenclature::class);
    }
}
