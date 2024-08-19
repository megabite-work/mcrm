<?php

namespace App\Action\Category;

use App\Component\EntityNotFoundException;
use App\Dto\Category\RequestDto;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class UpdateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $id, RequestDto $dto): Category
    {
        $category = $this->updateCategory($id, $dto);

        $this->em->flush();

        return $category;
    }

    private function updateCategory(int $id, RequestDto $dto): Category
    {
        $category = $this->em->find(Category::class, $id);

        if (null === $category) {
            throw new EntityNotFoundException('not found');
        }

        $this->setName($category, $dto);
        $this->setParent($category, $dto);

        if ($dto->getImage()) {
            $category->setImage($dto->getImage());
        }
        if (null !== $dto->getIsActive()) {
            $category->setIsActive($dto->getIsActive());
        }

        return $category;
    }

    private function setName(Category $category, RequestDto $dto): void
    {
        if ($dto->getNameUz() || $dto->getNameUzc() || $dto->getNameRu()) {
            $categoryName = $category->getName();
            $name = [
                'ru' => $dto->getNameRu() ?? $categoryName['ru'],
                'uz' => $dto->getNameUz() ?? $categoryName['uz'],
                'uzc' => $dto->getNameUzc() ?? $categoryName['uzc'],
            ];

            $name = json_decode(json_encode($name, JSON_UNESCAPED_UNICODE), true);
            $category->setName($name);
        }
    }

    private function setParent(Category $category, RequestDto $dto): void
    {
        if ($dto->getParentId()) {
            $parent = $this->em->find(Category::class, $dto->getParentId());

            if (null === $parent) {
                throw new EntityNotFoundException('parent not found');
            }

            $category->setParent($parent);
        }
    }
}
