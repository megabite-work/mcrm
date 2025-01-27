<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Nomenclature\RequestDto;
use App\Dto\Nomenclature\RequestQueryDto;
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

    public function findAllNomenclaturesByCategory(RequestQueryDto $dto): Paginator
    {
        $qb = $this->createQueryBuilder('n');

        $params = new ArrayCollection([
            new Parameter('mid', $dto->multiStoreId, Types::INTEGER),
            new Parameter('cid', $dto->categoryIds),
            new Parameter('name', '%'.$dto->name.'%', Types::STRING),
        ]);

        $query = $qb
            ->select('n, sn, wn, u')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->leftJoin('n.webNomenclature', 'wn')
            ->leftJoin('n.unit', 'u')
            ->join('n.category', 'c')
            ->join('n.multiStore', 'm')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('m.id', ':mid'),
                $qb->expr()->in('c.id', ':cid'),
                $qb->expr()->orX(
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.ru')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.uz')", ':name'),
                    $qb->expr()->like("JSON_EXTRACT(n.name, '$.uzc')", ':name')
                )
            ))
            ->setParameters($params);

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllNomenclatures(RequestQueryDto $dto): Paginator
    {
        $qb = $this->createQueryBuilder('n');

        $params = new ArrayCollection([
            new Parameter('mid', $dto->multiStoreId, Types::INTEGER),
            new Parameter('name', '%'.$dto->name.'%', Types::STRING),
        ]);

        $query = $qb
            ->select('n, sn, u')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->leftJoin('n.unit', 'u')
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

    public function IsUniqueNameByMultiStore(RequestDto $dto): bool
    {
        $qb = $this->createQueryBuilder('n');
        $params = new ArrayCollection([
            new Parameter('mid', $dto->multiStoreId, Types::INTEGER),
            new Parameter('name', $dto->nameRu, Types::STRING),
        ]);
        $query = $qb
            ->select('n.id')
            ->join('n.multiStore', 'm')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('m.id', ':mid'),
                $qb->expr()->eq("JSON_EXTRACT(n.name, '$.ru')", ':name'),
            ))
            ->setParameters($params)->getQuery();

        return count($query->getScalarResult()) ? false : true;
    }
}
