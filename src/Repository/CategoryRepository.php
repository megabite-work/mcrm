<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebCredential;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Query\Parameter;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAllCategoriesByParent(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $parent = $em->getReference(Category::class, $dto->parentId);
        $ids = null;

        $qb = $this->createQueryBuilder('c');
        $query = $qb->select('c, p, ch')
            ->leftJoin('c.parent', 'p')
            ->leftJoin('c.childrens', 'ch')
            ->where('c.parent = :parent')
            ->setParameter('parent', $parent);

        if ($dto->multiStoreId) {
            $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
            $ids = $em->getRepository(WebCredential::class)->findOneBy(['multiStore' => $multiStore])?->getCatalogTypeId();
            
            if ($ids) {
                $query->andWhere('c.id IN (:ids)')->setParameter('ids', $ids);
            }
        }

        if ($dto->generation) {
            $query->andWhere('c.generation = :generation')->setParameter('generation', $dto->generation);
        }
        
        if ($dto->name) {
            $query->andWhere($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.ru')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.uz')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.uzc')", ':name')
            ))->setParameter('name', $dto->name);
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllCategoriesParentIsNull(RequestQueryDto $dto): Paginator
    {
        $ids = null;
        $qb = $this->createQueryBuilder('c');
        $query = $qb->select('c, p, ch')
            ->leftJoin('c.parent', 'p')
            ->leftJoin('c.childrens', 'ch');

        if ($dto->multiStoreId) {
            $em = $this->getEntityManager();
            $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
            $ids = $em->getRepository(WebCredential::class)->findOneBy(['multiStore' => $multiStore])?->getCatalogTypeId();
            if ($ids) {
                $query->andWhere('c.id IN (:ids)')->setParameter('ids', $ids);
            }
        }

        if ($dto->generation) {
            $query->andWhere('c.generation = :generation')->setParameter('generation', $dto->generation);
        }
        
        if ($dto->name) {
            $query->andWhere($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.ru')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.uz')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(с.name, '$.uzc')", ':name')
            ))->setParameter('name', $dto->name);
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findCategoryByIdWithParentAndChildrens(int $id): ?Category
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT c, p, ch
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            LEFT JOIN c.childrens ch
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findCategoryFromCredential(?array $ids = []): array
    {
        if (empty($ids)) {
            return [];
        }

        return $this->getEntityManager()
            ->createQuery(
                'SELECT c, p, ch
                FROM App\Entity\Category c
                LEFT JOIN c.parent p
                LEFT JOIN c.childrens ch
                WHERE c.id IN (:ids)'
            )
            ->setParameter('ids', $ids)
            ->getResult();
    }
}
