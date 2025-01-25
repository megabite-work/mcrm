<?php

namespace App\Action\WebEvent;

use App\Dto\Category\IndexDto as CategoryDto;
use App\Dto\WebEvent\IndexDto;
use App\Dto\WebNomenclature\IndexDto as WebNomenclatureDto;
use App\Entity\Category;
use App\Entity\WebNomenclature;
use App\Repository\WebEventRepository;
use Doctrine\ORM\EntityManagerInterface;

class ShowAction
{
    public function __construct(
        private WebEventRepository $repo,
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id): IndexDto
    {
        $entity = $this->repo->find($id);
        $typeIds = null;
        
        if ($entity->getType() === 'product') {
            $typeIds = array_map(function ($id) {
                return WebNomenclatureDto::fromEntityForNomenclature($this->em->getRepository(WebNomenclature::class)->find($id));
            }, $entity->getTypeIds());
        } else if ($entity->getType() === 'category') {
            $typeIds = array_map(function ($id) {
                return CategoryDto::fromEntity($this->em->getRepository(Category::class)->findCategoryByIdWithParentAndChildrens($id));
            }, $entity->getTypeIds());
        }

        return IndexDto::fromEntity($entity, $typeIds);
    }
}
