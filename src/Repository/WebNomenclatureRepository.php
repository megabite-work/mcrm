<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Entity\MultiStore;
use App\Entity\WebNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $em = $this->getEntityManager();
        $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
        $qb = $this->createQueryBuilder('wn');

        $query = $qb
            ->select('wn', 'n', 'u', 'sn', 'c')
            ->join('wn.nomenclature', 'n')
            ->join('n.category', 'c')
            ->leftJoin('n.unit', 'u')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->where('n.multiStore = :multiStore')
            ->setParameter('multiStore', $multiStore);

        if ($dto->nomenclatureId) {
            $query->andWhere('n.id = :nid')->setParameter('nid', $dto->nomenclatureId);
        }
        if ($dto->categoryId) {
            $query->andWhere('c.id = :cid')->setParameter('cid', $dto->categoryId);
        }
        if ($dto->title) {
            $query->andWhere($qb->expr()->like('wn.title', ':title'))->setParameter('title', '%' . $dto->title . '%');
        }
        if (null !== $dto->isActive) {
            $query->andWhere('wn.isActive = :isActive')->setParameter('isActive', $dto->isActive);
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findWebNomenclatureByIdWithCategoryUnitStoreNomenclature(int $id): ?WebNomenclature
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT wn, n, c, u, sn, s, a, p
            FROM App\Entity\WebNomenclature wn
            JOIN wn.nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            LEFT JOIN sn.store s
            LEFT JOIN s.address a
            LEFT JOIN s.phones p
            WHERE wn.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findWebNomenclatureByIdWithNomenclature(int $id): ?WebNomenclature
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT wn, n
            FROM App\Entity\WebNomenclature wn
            JOIN wn.nomenclature n
            WHERE wn.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findWebNomenclatureWithWebAttributeValues(int $id): ?WebNomenclature
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT wn, wav
            FROM App\Entity\WebNomenclature wn
            LEFT JOIN wn.webAttributeValues wav
            WHERE wn.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findAllUserFavoritesByIds(array $ids): Paginator
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT wn, n, un, sn, c
            FROM App\Entity\WebNomenclature wn
            JOIN wn.nomenclature n
            JOIN n.category c
            LEFT JOIN n.unit un
            LEFT JOIN n.storeNomenclatures sn
            WHERE wn.id IN (:ids)'
        )->setParameter('ids', $ids);

        return new Paginator($query);
    }
}
