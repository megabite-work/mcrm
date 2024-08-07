<?php

namespace App\Action\Category;

use App\Component\Paginator;
use App\Dto\Category\RequestQueryDto;
use App\Repository\CategoryRepository;

class IndexAction
{
    public function __construct(
        private CategoryRepository $repo
    ) {
    }

    public function __invoke(RequestQueryDto $dto): Paginator
    {
        if ($dto->getParentId()) {
            $parent = $this->repo->find($dto->getParentId());
            $categories = $this->repo->findAllCategoriesByParent($parent, $dto->getPage(), $dto->getPerPage());
        } else {
            $categories = $this->repo->findAllCategoriesByParentIsNull($dto->getPage(), $dto->getPerPage());
        }

        return $categories;
    }
}
