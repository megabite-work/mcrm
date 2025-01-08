<?php

namespace App\Action\UserCredential;

use App\Dto\UserCredential\IndexDto;
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowAction
{
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user, int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findOneBy(['id' => $id, 'owner' => $user]));
    }
}
