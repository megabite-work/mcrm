<?php

namespace App\Action\Category;

use App\Component\EntityNotFoundException;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(int $id): bool
    {
        $category = $this->em->find(Category::class, $id);

        if (null === $category) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($category);
        $this->em->flush();

        return true;
    }
}
