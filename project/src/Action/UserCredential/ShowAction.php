<?php

namespace App\Action\UserCredential;

<<<<<<< HEAD
use App\Dto\UserCredential\IndexDto;
=======
use App\Component\EntityNotFoundException;
use App\Entity\UserCredential;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
use App\Repository\UserCredentialRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ShowAction
{
<<<<<<< HEAD
    public function __construct(
        private UserCredentialRepository $repo
    ) {}

    public function __invoke(UserInterface $user, int $id): IndexDto
    {
        return IndexDto::fromEntity($this->repo->findOneBy(['id' => $id, 'owner' => $user]));
=======
    public function __construct(private UserCredentialRepository $repo)
    {
    }

    public function __invoke(UserInterface $user, int $id): UserCredential
    {
        $userCredential = $this->repo->findOneBy(['id' => $id, 'owner' => $user]);

        if (null === $userCredential) {
            throw new EntityNotFoundException('not found');
        }

        return $userCredential;
>>>>>>> b6d1ea7 (feat: add DTO classes for various entities and implement error handling)
    }
}
