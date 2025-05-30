<?php

namespace App\Repository;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebCredential;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
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

    public function findAllCategories(RequestQueryDto $dto): Paginator
    {
        $em = $this->getEntityManager();
        $ids = null;

        $qb = $this->createQueryBuilder('c');
        $query = $qb->select('c', 'p', 'ch')
            ->leftJoin('c.parent', 'p')
            ->leftJoin('c.childrens', 'ch');

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

        if ($dto->parentId) {
            $parent = $em->getReference(Category::class, $dto->parentId);
            $query->andWhere('c.parent = :parent')->setParameter('parent', $parent);
        }

        if ($dto->name) {
            $query->andWhere($qb->expr()->orX(
                $qb->expr()->like("JSON_EXTRACT(c.name, '$.ru')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(c.name, '$.uz')", ':name'),
                $qb->expr()->like("JSON_EXTRACT(c.name, '$.uzc')", ':name')
            ))->setParameter('name', '%' . $dto->name . '%', Types::STRING);
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

    public function findCategoryWithParentAndChildrens(array $ids): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT c, p, ch
            FROM App\Entity\Category c
            LEFT JOIN c.parent p
            LEFT JOIN c.childrens ch
            WHERE c.id IN (:ids)'
        )->setParameter('ids', $ids);

        return $query->getResult();
    }

    public function getCategoryIds(array $categoryIds): array
    {
        $categories = $this->findCategoryWithParentAndChildrens($categoryIds);
        $ids = [];

        foreach ($categories as $category) {
            if ($category->getGeneration() === Category::GENERATIONS[0]) {
                $ids = array_merge($ids, $this->getCategoryIds(
                    $category->getChildrens()->map(fn(Category $category) => $category->getId())->toArray()
                ));
            } else if ($category->getGeneration() === Category::GENERATIONS[1]) {
                $ids = array_merge($ids, $category->getChildrens()->map(fn(Category $category) => $category->getId())->toArray());
            } else if ($category->getGeneration() === Category::GENERATIONS[2]) {
                $ids[] = $category->getId();
            }
        }

        return array_unique($ids);
    }
}
