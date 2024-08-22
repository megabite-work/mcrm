<?php

namespace App\Repository;

use App\Entity\MultiStore;
use App\Component\Paginator;
use Doctrine\DBAL\Types\Types;
use App\Entity\WebNomenclature;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Entity\Nomenclature;
use Doctrine\Common\Collections\ArrayCollection;
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
        $qb = $entityManager->createQueryBuilder();

        $params = new ArrayCollection([
            new Parameter('multiStore', $multiStore),
            new Parameter('id', $dto->getNomenclatureId(), Types::INTEGER),
            new Parameter('title', '%'.$dto->getTitle().'%', Types::STRING),
        ]);

        $query = $qb
            ->select('wn, n, c, u, sn')
            ->from(WebNomenclature::class, 'wn')
            ->join('wn.nomenclature', 'n')
            ->leftJoin('n.category', 'c')
            ->leftJoin('n.unit', 'u')
            ->leftJoin('n.storeNomenclatures', 'sn')
            // ->leftJoin('sn.store', 's')
            // ->leftJoin('s.address', 'a')
            // ->leftJoin('s.phones', 'p')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('n.multiStore', ':multiStore'),
                $qb->expr()->orX(
                    $qb->expr()->eq('n.id', ':id'),
                    $qb->expr()->like('wn.title', ':title')
                )
            ))
            ->setParameters($params);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findWebNomenclatureByIdWithCategoryUnitStoreNomenclature(int $id): ?WebNomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT wn, n, c, u, sn
            FROM App\Entity\WebNomenclature wn
            JOIN wn.nomenclature n
            LEFT JOIN n.category c
            LEFT JOIN n.unit u
            LEFT JOIN n.storeNomenclatures sn
            -- LEFT JOIN sn.store s
            -- LEFT JOIN s.address a
            -- LEFT JOIN s.phones p
            WHERE wn.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
