<?php

namespace App\Action\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserRepository $userRepo
    ) {
    }

    public function __invoke(int $id): void
    {
        $user = $this->userRepo->find($id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        $this->em->remove($user);
        $this->em->flush();
    }
}
