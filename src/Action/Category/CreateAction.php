<?php

namespace App\Action\Category;

use App\Dto\Category\IndexDto;
use App\Dto\Category\RequestDto;
use App\Entity\Category;
use App\Exception\ErrorException;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CategoryRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $parent = $dto->parentId ? $this->repo->findCategoryByIdWithParentAndChildrens($dto->parentId) : null;

        $entity = (new Category())
            ->setName($dto->getName())
            ->setImage($dto->image)
            ->setGeneration($this->getGenerationByParent($parent))
            ->setParent($parent);

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    public function getGenerationByParent(?Category $parent = null): string
    {
        $generation = 'class';

        if ($parent?->getGeneration() === 'class') {
            $generation = 'category';
        } else if ($parent?->getGeneration() === 'category') {
            $generation = 'subcategory';
        } else if ($parent?->getGeneration() === 'subcategory') {
            return throw new ErrorException('Category', ' cannot be a subcategory of a subcategory.');
        }

        return $generation;
    }
}
