<?php

namespace App\Action\Attribute;

use App\Component\EntityNotFoundException;
use App\Entity\Category;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class DetachAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(int $attributeId, int $categoryId): bool
    {
        $category = $this->em->find(Category::class, $categoryId);
        $attribute = $this->em->find(AttributeEntity::class, $attributeId);

        if (null === $category || null === $attribute) {
            throw new EntityNotFoundException('category or attribute not found');
        }

        $attribute->removeCategory($category);

        $this->em->flush();

        return !$attribute->getCategories()->contains($category);
    }
}
