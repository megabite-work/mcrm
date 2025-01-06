<?php

namespace App\Action\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
<<<<<<< HEAD
=======
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em
<<<<<<< HEAD
    ) {}

    public function __invoke(int $id): void
    {
        $user = $this->em->find(User::class, $id);
        $this->em->remove($user);
        $this->em->flush();
=======
    ) {
    }

    public function __invoke(int $id): bool
    {
        $user = $this->em->find(User::class, $id);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        $this->em->remove($user);
        $this->em->flush();

        return true;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
