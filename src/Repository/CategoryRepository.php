<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebCredential;
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

    public function findAllCategoriesByParent(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $parent = $em->getReference(Category::class, $dto->parentId);
        $ids = null;

        if ($dto->multiStoreId) {
            $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
            $ids = $em->getRepository(WebCredential::class)->findOneBy(['multiStore' => $multiStore])?->getCatalogTypeId();
        }

        $dql = 'SELECT c, p, ch
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            LEFT JOIN c.childrens ch
            WHERE c.parent = :parent';

        if ($ids) {
            $dql .= ' AND c.id IN (:ids)';
        }

        $query = $em->createQuery($dql)->setParameter('parent', $parent);

        if ($ids) {
            $query->setParameter('ids', $ids);
        }

        return new Paginator($query, $dto->page, $dto->perPage);
    }

    public function findAllCategoriesParentIsNull(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $ids = null;

        if ($dto->multiStoreId) {
            $multiStore = $em->getReference(MultiStore::class, $dto->multiStoreId);
            $ids = $em->getRepository(WebCredential::class)->findOneBy(['multiStore' => $multiStore])?->getCatalogTypeId();
        }

        $dql = 'SELECT c, p, ch
        FROM App\Entity\Category c
        LEFT JOIN c.parent p
        LEFT JOIN c.childrens ch';

        if ($ids) {
            $dql .= ' AND c.id IN (:ids)';
        }

        $query = $em->createQuery($dql);

        if ($ids) {
            $query->setParameter('ids', $ids);
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
}
