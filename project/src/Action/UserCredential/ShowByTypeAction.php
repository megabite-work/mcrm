<?php

namespace App\Action\UserCredential;

use App\Component\EntityNotFoundException;
use App\Entity\User;
use App\Entity\UserCredential;
use App\Repository\UserCredentialRepository;

class ShowByTypeAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(User $user, string $type): ?UserCredential
    {
        if (!in_array($type, UserCredential::TYPES)) {
            throw new EntityNotFoundException('Available types: ' . "'" . implode("','", UserCredential::TYPES) . "'", 400);
        }

        $userCredential = $this->repo->findUserCredentialByType($user, $type);

        return $userCredential;
    }
}
