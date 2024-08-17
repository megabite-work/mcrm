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
            $categories = $this->repo->findAllCategoriesByParent($dto);
        } else {
            $categories = $this->repo->findAllCategoriesByParentIsNull($dto);
        }

        return $categories;
    }
}
