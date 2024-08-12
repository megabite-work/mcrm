<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findAllCategoriesByParent(Category $parent, RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            WHERE c.parent = :parent'
        )->setParameter('parent', $parent);

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findAllCategoriesByParentIsNull(RequestQueryDto $dto): Paginator
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            WHERE c.parent IS NULL'
        );

        return new Paginator($query, $dto->getPage(), $dto->getPerPage(), false);
    }

    public function findCategoryByIdWithParentAndChildrens(int $id): ?Category
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
