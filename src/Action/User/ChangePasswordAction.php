<?php

namespace App\Action\User;

use App\Dto\User\RequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class ChangePasswordAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $repo
    ) {
    }

    public function __invoke(User $user, RequestDto $dto): void
    {
        if (null == $user || !$this->passwordHasher->isPasswordValid($user, $dto->oldPassword)) {
            throw new UserNotFoundException();
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $dto->password);
        $this->repo->upgradePassword($user, $hashedPassword);
    }
}
