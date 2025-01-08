<?php

namespace App\Action\WebEvent;

use App\Component\EntityNotFoundException;
use App\Dto\WebEvent\IndexDto;
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
        $entity = $this->repo->find($id) ?? throw new EntityNotFoundException('not found');
        if ($entity->getType() === 'product') {
            $typeIds = array_map(function ($id) {
                $webNomenclature = $this->em->getRepository(WebNomenclature::class)->find($id);

                return [
                    'id' => $webNomenclature->getId(),
                    'article' => $webNomenclature->getArticle(),
                    'title' => $webNomenclature->getTitle(),
                    'images' => $webNomenclature->getImages(),
                    'description' => $webNomenclature->getDescription(),
                    'document' => $webNomenclature->getDocument(),
                    'isActive' => $webNomenclature->getIsActive(),
                ];
            }, $entity->getTypeIds());
        } else if ($entity->getType() === 'category') {
            $typeIds = array_map(function ($id) {
                $category = $this->em->getRepository(Category::class)->findCategoryByIdWithParentAndChildrens($id);

                return [
                    'id' => $category->getId(),
                    'name' => $category->getName(),
                    'image' => $category->getImage(),
                    'isActive' => $category->getIsActive(),
                    'parentId' => $category->getParentId(),
                    'hasChild' => $category->getHasChild(),
                ];
            }, $entity->getTypeIds());
        }

        return IndexDto::fromEntity($entity, $typeIds);
    }
}
