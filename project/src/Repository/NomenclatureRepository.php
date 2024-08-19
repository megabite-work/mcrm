<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Nomenclature\RequestDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Dto\StoreNomenclature\RequestQueryDto as StoreNomenclatureRequestQueryDto;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
use App\Entity\Store;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

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
        $qb = $this->createQueryBuilder('n');

        $params = new ArrayCollection([
            new Parameter('mid', $dto->getMultiStoreId(), Types::INTEGER),
            new Parameter('cid', $dto->getCategoryId(), Types::INTEGER),
            new Parameter('name', $dto->getName(), Types::STRING),
        ]);

        $query = $qb
            ->select('n, sn')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->join('n.category', 'c')
            ->join('n.multiStore', 'm')
            ->where('m.id = :mid')
            ->andWhere('c.id = :cid')
            ->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.ru')", ':name'))
            ->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uz')", ':name'))
            ->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uzc')", ':name'))
            ->setParameters($params);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllNomenclatures(RequestQueryDto $dto): Paginator
    {
        $qb = $this->createQueryBuilder('n');

        $params = new ArrayCollection([
            new Parameter('mid', $dto->getMultiStoreId(), Types::INTEGER),
            new Parameter('name', $dto->getName(), Types::STRING),
        ]);

        $query = $qb
            ->select('n, sn')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->join('n.multiStore', 'm')
            ->where('m.id = :mid')
            ->andWhere(
                $qb->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.ru')", ':name')),
                $qb->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uz')", ':name')),
                $qb->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uzc')", ':name'))
            )
            // ->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uz')", ':name'))
            // ->orWhere($qb->expr()->like("JSON_EXTRACT(n.name, '$.uzc')", ':name'))
            ->setParameters($params);

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
