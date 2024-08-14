<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Entity\User;
use App\Entity\UserCredential;
use App\Repository\UserCredentialRepository;

class ShowAction
{
    public function __construct(private UserCredentialRepository $repo)
    {
    }

    public function __invoke(User $user, int $id): UserCredential
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        return $userCredential;
    }
}
