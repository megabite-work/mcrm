<?php

namespace App\Action\Category;

use App\Component\EntityNotFoundException;
use App\Entity\Category;
use App\Repository\CategoryRepository;

class ShowAction
{
    public function __construct(private CategoryRepository $repo)
    {
    }

    public function __invoke(int $id): Category
    {
        $category = $this->repo->findCategoryByIdWithParentAndChildrens($id);

        if (null === $category) {
            throw new EntityNotFoundException('not found');
        }

        return $category;
    }
}
