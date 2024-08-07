<?php

namespace App\Action\Category;

use App\Component\EntityNotFoundException;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private CategoryRepository $repo
    ) {
    }

    public function __invoke(int $id): bool
    {
        $category = $this->repo->find($id);

        if (null === $category) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($category);
        $this->em->flush();

        return true;
    }
}
