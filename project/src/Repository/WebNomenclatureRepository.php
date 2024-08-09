<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Entity\WebNomenclature;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Entity\MultiStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<WebNomenclature>
 */
class WebNomenclatureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebNomenclature::class);
    }

    public function findAllWebNomenclaturesByMultiStore(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());

        $query = $entityManager->createQuery(
            'SELECT n, wn, c, u, sn
            FROM App\Entity\Nomenclature n
            JOIN n.webNomenclature wn
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            WHERE n.multiStore = :multiStore'
        )->setParameter('multiStore', $multiStore);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findWebNomenclatureByIdWithCategoryUnitStoreNomenclature(int $id): WebNomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT n, wn, c, u, sn
            FROM App\Entity\Nomenclature n
            JOIN n.webNomenclature wn
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            WHERE wn.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
