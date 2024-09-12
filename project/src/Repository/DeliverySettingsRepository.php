<?php

namespace App\Repository;

use App\Entity\Store;
use App\Component\Paginator;
use App\Entity\DeliverySettings;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\DeliverySettings\RequestQueryDto;
use App\Entity\MultiStore;
use App\Entity\Region;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<DeliverySettings>
 */
class DeliverySettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeliverySettings::class);
    }

    public function findAllDeliverySettingsByStoreAndRegion(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $dto->getStoreId());
        $region = $entityManager->find(Region::class, $dto->getRegionId());

        $query = $entityManager->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store = :store AND ds.region = :region'
        )->setParameters(['store' => $store, 'region' => $region]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllDeliverySettingsByStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $store = $entityManager->find(Store::class, $dto->getStoreId());

        $query = $entityManager->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store = :store'
        )->setParameters(['store' => $store]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllDeliverySettingsByMultiStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());
        $stores = $entityManager->getRepository(Store::class)->findBy(['multiStore' => $multiStore]);

        $query = $entityManager->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.store IN (:stores)'
        )->setParameters(['stores' => $stores]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllDeliverySettingsByRegion(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $region = $entityManager->find(Region::class, $dto->getRegionId());

        $query = $entityManager->createQuery(
            'SELECT ds, r, s
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.region = :region'
        )->setParameters(['region' => $region]);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findDeliverySettingsByIdWithStoreAndRegion(int $id): ?DeliverySettings
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ds, s, r
            FROM App\Entity\DeliverySettings ds
            JOIN ds.store s
            JOIN ds.region r
            WHERE ds.id = :id'
        )->setParameters(['id' => $id]);

        return $query->getOneOrNullResult();
    }
}
