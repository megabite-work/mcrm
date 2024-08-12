<?php

namespace App\Repository;

use App\Entity\Store;
use App\Entity\MultiStore;
use App\Component\Paginator;
use App\Entity\Nomenclature;
use App\Dto\Nomenclature\RequestDto;
use App\Dto\Nomenclature\RequestQueryDto;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Dto\StoreNomenclature\RequestQueryDto as StoreNomenclatureRequestQueryDto;

/**
 * @extends ServiceEntityRepository<Nomenclature>
 */
class NomenclatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nomenclature::class);
    }

    public function findAllNomenclaturesByCategory(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT n, sn
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.storeNomenclatures sn
            JOIN n.category c
            JOIN n.multiStore m
            WHERE c.id = :cid AND m.id = :mid'
        )->setParameters(['cid' => $dto->getCategoryId(), 'mid' => $dto->getMultiStoreId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllNomenclatures(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT n, sn
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.storeNomenclatures sn
            JOIN n.multiStore m
            WHERE m.id = :mid'
        )->setParameters(['mid' => $dto->getMultiStoreId()]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllNomenclaturesWithStoreAndCategory(int $storeId, StoreNomenclatureRequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $storeId);

        $query = $entityManager->createQuery(
            'SELECT n, sn, c
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.storeNomenclatures sn
            WHERE c.id = :id OR sn.store = :store'
        )->setParameters(['id' => $dto->getCategoryId(), 'store' => $store]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllNomenclaturesWithStore(int $storeId, StoreNomenclatureRequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $storeId);

        $query = $entityManager->createQuery(
            'SELECT n, sn
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.storeNomenclatures sn
            WHERE sn.store = :store'
        )->setParameters(['store' => $store]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), true);
    }

    public function findNomenclatureById(int $id): ?Nomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT n, sn, c, u
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            WHERE n.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findNomenclatureByIdWithStore(int $storeId, int $nomenclatureId): ?Nomenclature
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $storeId);

        $query = $entityManager->createQuery(
            'SELECT n, sn, c, u
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            WHERE n.id = :id AND sn.store = :store'
        )->setParameters(['id' => $nomenclatureId, 'store' => $store]);

        return $query->getOneOrNullResult();
    }

    public function IsUniqueBarcodeByMultiStore(RequestDto $dto): ?bool
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());

        return null === $this->findOneBy(['multiStore' => $multiStore, 'barcode' => $dto->getBarcode()]);
    }
}
