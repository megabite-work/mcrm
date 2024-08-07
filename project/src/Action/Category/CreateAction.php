<?php

namespace App\Action\Category;

use App\Entity\Category;
use App\Dto\Category\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): Category
    {
        $category = (new Category())
            ->setName($dto->getName())
            ->setImage($dto->getImage());

        if ($dto->getParentId()) {
            $parent = $this->em->find(Category::class, $dto->getParentId());
            
            if (null === $parent) {
                throw new EntityNotFoundException('parent not found');
            }

            $category->setParent($parent);
        }

        $this->em->persist($category);
        $this->em->flush();

        return $category;
    }
}
