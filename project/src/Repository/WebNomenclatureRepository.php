<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\WebNomenclature\RequestQueryDto;
use App\Entity\MultiStore;
use App\Entity\WebNomenclature;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Query\Parameter;
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
        $entityManager = $this->getEntityManager();
        $multiStore = $entityManager->find(MultiStore::class, $dto->getMultiStoreId());
        $qb = $this->createQueryBuilder('wn');

        // $params = new ArrayCollection([
        //     new Parameter('multiStore', $multiStore),
        //     new Parameter('nid', $dto->getNomenclatureId(), Types::INTEGER),
        //     new Parameter('cid', $dto->getCategoryId(), Types::INTEGER),
        //     new Parameter('title', '%' . $dto->getTitle() . '%', Types::STRING),
        // ]);

        $query = $qb
            ->select('wn', 'n', 'u', 'sn', 'c')
            ->join('wn.nomenclature', 'n')
            ->join('n.category', 'c')
            ->leftJoin('n.unit', 'u')
            ->leftJoin('n.storeNomenclatures', 'sn')
            ->where('n.multiStore = :multiStore')
            // ->where($qb->expr()->andX(
            //     $qb->expr()->eq('n.multiStore', ':multiStore'),
            //     $qb->expr()->orX(
            //         $qb->expr()->eq('n.id', ':nid'),
            //         $qb->expr()->eq('n.category.id', ':cid'),
            //         $qb->expr()->like('wn.title', ':title')
            //     )
            // ))
            ->setParameter('multiStore', $multiStore);

        if ($dto->getNomenclatureId()) {
            $query->andWhere('n.id = :nid')->setParameter('nid', $dto->getNomenclatureId());
        }
        if ($dto->getCategoryId()) {
            $query->andWhere('c.id = :cid')->setParameter('cid', $dto->getCategoryId());
        }
        if ($dto->getTitle()) {
            $query->andWhere($qb->expr()->like('wn.title', ':title'))->setParameter('title', '%' . $dto->getTitle() . '%');
        }

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), true);
    }

    public function findWebNomenclatureByIdWithCategoryUnitStoreNomenclature(int $id): ?WebNomenclature
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
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
}
