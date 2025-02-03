<?php

namespace App\Action\Nomenclature;

use App\Dto\Base\ListResponseDto;
use App\Dto\Base\ListResponseDtoInterface;
use App\Dto\Nomenclature\IndexDto;
use App\Dto\Nomenclature\RequestQueryDto;
use App\Entity\Category;
use App\Repository\NomenclatureRepository;
use Doctrine\ORM\EntityManagerInterface;

class IndexAction
{
    public function __construct(
        private NomenclatureRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestQueryDto $dto): ListResponseDtoInterface
    {
        dd($this->getCategoryIds($dto->categoryIds));
        $paginator = $this->repo->findAllNomenclatures($dto);
        $data = $paginator->getData();

        array_walk_recursive($data, function (&$entity) {
            $entity = IndexDto::fromShowAction($entity);
        });

        return new ListResponseDto($data, $paginator->getPagination());
    }

    private function getCategoryIds(array $categoryIds): array
    {
        $categories = $this->em->getRepository(Category::class)->findCategoryWithParentAndChildrens($categoryIds);
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
