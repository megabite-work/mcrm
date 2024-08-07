<?php

namespace App\Action\Category;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Repository\CategoryRepository;

class IndexAction
{
    public function __construct(
        private CategoryRepository $categoryRepo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        if ($dto->getParentId()) {
            $parent = $this->categoryRepo->find($dto->getParentId());
            $categories = $this->categoryRepo->findAllCategoriesByParent($parent, $dto->getPage(), $dto->getPerPage());
        } else {
            $categories = $this->categoryRepo->findAllCategoriesByParentIsNull($dto->getPage(), $dto->getPerPage());
        }

        return $categories;
    }
}
