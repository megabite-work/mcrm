<?php

namespace App\Action\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $repo
    ) {
    }

    public function __invoke(int $id): bool
    {
        $user = $this->repo->find($id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        $this->em->remove($user);
        $this->em->flush();

        return true;
    }
}
