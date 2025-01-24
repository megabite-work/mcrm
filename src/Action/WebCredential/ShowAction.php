<?php

namespace App\Action\WebCredential;

use App\Dto\Category\IndexDto as CategoryIndexDto;
use App\Dto\WebCredential\IndexDto;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\MultiStoreRepository;

class ShowAction
{
    public function __construct(
        private MultiStoreRepository $repo,
        private CategoryRepository $categoryRepository
    ) {}

    public function __invoke(int $multiStoreId): IndexDto
    {
        $multiStore = $this->repo->findMultiStoreByIdWithWebCredential($multiStoreId);
        $catalogTypes = array_map(
            fn(Category $category)  => CategoryIndexDto::fromEntity($category),
            $this->categoryRepository->findCategoryFromCredential($multiStore->getWebCredential()->getCatalogTypeId())
        );
        
        return IndexDto::fromEntity($multiStore->getWebCredential(), $catalogTypes);
    }
}
