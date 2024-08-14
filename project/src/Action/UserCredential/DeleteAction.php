<?php

namespace App\Action\UserCredential;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use App\Repository\UserCredentialRepository;

class DeleteAction
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserCredentialRepository $repo
    ) {
    }

    public function __invoke(User $user, int $id): bool
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        $this->em->remove($userCredential);
        $this->em->flush();

        return true;
    }
}
