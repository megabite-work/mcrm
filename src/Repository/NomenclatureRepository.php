<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Nomenclature\RequestDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
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

    public function findAllNomenclatures(RequestQueryDto $dto): Paginator
    {
        $qb = $this->createQueryBuilder('n');
        $params = new ArrayCollection([
            new Parameter('mid', $dto->multiStoreId, Types::INTEGER),
            new Parameter('name', '%' . $dto->name . '%', Types::STRING),
        ]);

        $query = $qb
            ->select('n, sn, wn, u, c')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->leftJoin('n.webNomenclature', 'wn')
            ->leftJoin('n.unit', 'u')
            ->join('n.category', 'c')
            ->join('n.multiStore', 'm')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('m.id', ':mid'),
                $qb->expr()->orX(
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.ru')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.uz')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.uzc')", ':name')
                )
            ))
            ->setParameters($params);

        if ($dto->hasWebNomenclature === true) {
            $query->andWhere('wn.id IS NOT NULL');
        } else if ($dto->hasWebNomenclature === false) {
            $query->andWhere('wn.id IS NULL');
        } 
        if ($dto->categoryIds) {
            $categoryIds = $this->getEntityManager()->getRepository(Category::class)->getCategoryIds($dto->categoryIds);
            $query->andWhere('c.id IN (:cid)')->setParameter('cid', $categoryIds);
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findNomenclatureById(int $id): ?Nomenclature
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT n, sn, c, u, wn
            FROM App\Entity\Nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            LEFT JOIN n.webNomenclature wn
            WHERE n.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function IsUniqueBarcodeByMultiStore(RequestDto $dto): ?bool
    {
        $em = $this->getEntityManager();
        $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);

        return null === $this->findOneBy(['multiStore' => $multiStore, 'barcode' => $dto->barcode]);
    }

    public function IsUniqueNameByMultiStore(RequestDto $dto, ?int $multiStoreId = null): bool
    {
        $qb = $this->createQueryBuilder('n');
        $params = new ArrayCollection([
            new Parameter('mid', $dto->multiStoreId ?? $multiStoreId, Types::INTEGER),
            new Parameter('nameUz', $dto->nameUz, Types::STRING),
            new Parameter('nameRu', $dto->nameRu, Types::STRING),
            new Parameter('nameUzc', $dto->nameUzc, Types::STRING),
        ]);
        $query = $qb
            ->select('n.id')
            ->join('n.multiStore', 'm')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('m.id', ':mid'),
                $qb->expr()->orX(
                    $qb->expr()->eq("JSON_EXTRACT(n.name, '$.ru')", ':nameRu'),
                    $qb->expr()->eq("JSON_EXTRACT(n.name, '$.uz')", ':nameUz'),
                    $qb->expr()->eq("JSON_EXTRACT(n.name, '$.uzc')", ':nameUzc')
                ),
            ))
            ->setParameters($params)->getQuery();

        if ($multiStoreId) {
            return count($query->getScalarResult()) > 1 ? false : true;
        }

        return count($query->getScalarResult()) ? false : true;
    }

    public function findNomenclatureByIdWithMultiStore(int $id): ?Nomenclature
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT n, m
            FROM App\Entity\Nomenclature n
            JOIN n.multiStore m
            WHERE n.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
