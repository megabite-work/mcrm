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
        $generation = 'class';
        $parent = $dto->parentId ? $this->repo->findCategoryByIdWithParentAndChildrens($dto->parentId) : null;

        if ($parent?->getGeneration() === 'class') {
            $generation = 'category';
        } else if ($parent?->getGeneration() === 'category') {
            $generation = 'subcategory';
        } else if ($parent?->getGeneration() === 'subcategory') {
            return throw new ErrorException('Category', ' cannot be a subcategory of a subcategory.');
        }

        $entity = (new Category())
            ->setName($dto->getName())
            ->setImage($dto->image)
            ->setGeneration($generation)
            ->setParent($parent);

        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }
}
