<?php

namespace App\Repository;

use App\Entity\Category;
use App\Component\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Category>
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAllCategoriesByParent(Category $parent, int $page, int $perPage): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            WHERE c.parent = :parent'
        )->setParameter('parent', $parent);

        return new Paginator($query, $page, $perPage, false);
    }

    public function findAllCategoriesByParentIsNull(int $page, int $perPage): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            WHERE c.parent IS NULL'
        );

        return new Paginator($query, $page, $perPage, false);
    }

    public function findCategoryByIdWithParentAndChildrens(int $id): Category
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c, p, ch
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            LEFT JOIN c.childrens ch
            WHERE c.id = :id'
        )->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
