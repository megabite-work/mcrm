<?php

namespace App\Action\Attribute;

use App\Component\EntityNotFoundException;
use App\Dto\Attribute\RequestDto;
use App\Entity\Category;
use App\Entity\AttributeEntity;
use Doctrine\ORM\EntityManagerInterface;

class CreateAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    public function __invoke(RequestDto $dto): AttributeEntity
    {
        $category = $this->em->find(Category::class, $dto->getCategoryId());

        if (null === $category) {
            throw new EntityNotFoundException('category not found');
        }

        $entity = $this->create($dto, $category);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    private function create(RequestDto $dto, Category $category): AttributeEntity
    {
        $entity = (new AttributeEntity())
            ->setName($dto->getName())
            ->addCategory($category);

        return $entity;
    }
}
