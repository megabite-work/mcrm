<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\StoreNomenclature\RequestQueryDto;
use App\Entity\Nomenclature;
use App\Entity\Store;
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

    public function findStoreNomenclatureByStoreAndNomenclature(Store $store, Nomenclature $nomenclature): ?StoreNomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT sn
            FROM App\Entity\StoreNomenclature sn
            WHERE sn.store = :store AND sn.nomenclature = :nomenclature'
        )->setParameters(['store' => $store, 'nomenclature' => $nomenclature]);

        return $query->getOneOrNullResult();
    }

    public function findAllNomenclaturesWithStoreAndCategory(int $storeId, RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $storeId);
        $query = $em->createQuery(
            'SELECT sn, n
            FROM App\Entity\StoreNomenclature sn
            LEFT JOIN sn.nomenclature n
            LEFT JOIN n.category c
            WHERE c.id = :id OR sn.store = :store'
        )->setParameters(['id' => $dto->categoryId, 'store' => $store]);

        return new Paginator($query, $dto->page, $dto->perPage);
    }
    
    public function findNomenclatureByIdWithStore(int $storeId, int $nomenclatureId): ?Nomenclature
    {
        $em = $this->getEntityManager();
        $store = $em->getReference(Store::class, $storeId);

        $query = $em->createQuery(
            'SELECT sn, n, c, u
            FROM App\Entity\StoreNomenclature sn
            LEFT JOIN sn.nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            WHERE n.id = :id AND sn.store = :store'
        )->setParameters(['id' => $nomenclatureId, 'store' => $store]);

        return $query->getOneOrNullResult();
    }
}
