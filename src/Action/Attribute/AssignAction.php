<?php

namespace App\Action\Attribute;

use App\Dto\Attribute\AssignDto;
use App\Entity\AttributeEntity;
use App\Entity\Category;
use App\Repository\AttributeEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class AssignAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private AttributeEntityRepository $repo
    ) {}

    public function __invoke(AssignDto $dto): void
    {
        $category = $this->em->getReference(Category::class, $dto->categoryId);
        $attributes = $this->repo->findBy(['id' => $dto->attributeIds]);

        /** @var AttributeEntity $attribute */
        foreach ($attributes as $attribute) {
            $attribute->addCategory($category);
        }

        $this->em->flush();
    }
}
