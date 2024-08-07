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
    ) {
    }

    public function __invoke(int $id, RequestDto $dto): Category
    {
        $store = $this->updateCategory($id, $dto);

        $this->em->flush();

        return $store;
    }

    private function updateCategory(int $id, RequestDto $dto): Category
    {
        $category = $this->em->find(Category::class, $id);

        if (null === $category) {
            throw new EntityNotFoundException('not found');
        }

        if ($dto->getParentId()) {
            $parent = $this->em->find(Category::class, $dto->getParentId());

            if (null === $parent) {
                throw new EntityNotFoundException('parent not found');
            }
            
            $category->setParent($parent);
        }
        if ($dto->getName()) {
            $category->setName($dto->getName());
        }
        if ($dto->getImage()) {
            $category->setImage($dto->getImage());
        }
        if (null !== $dto->getIsActive()) {
            $category->setIsActive($dto->getIsActive());
        }

        return $category;
    }
}
