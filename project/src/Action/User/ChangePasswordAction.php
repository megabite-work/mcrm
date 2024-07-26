<?php

namespace App\Action\User;

use App\Dto\User\ShowResponseDto;
use App\Dto\User\ChangePasswordRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangePasswordAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepo
    ) {
    }

    public function __invoke(User $user, ChangePasswordRequestDto $dto): ShowResponseDto
    {
        if (null === $user || !$this->passwordHasher->isPasswordValid($user, $dto->getOldPassword())) {
            throw new UserNotFoundException();
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $dto->getPassword());
        $this->userRepo->upgradePassword($user, $hashedPassword);

        return new ShowResponseDto($user);
    }
}
