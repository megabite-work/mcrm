<?php

namespace App\Action\User;

use App\Dto\ForgotPassword\RequestDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class ResetPasswordAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(string $token, RequestDto $dto): array
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['token' => $token]);

        if (!$user || $user->isTokenExpired()) {
            return throw new UserNotFoundException();
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $dto->password);
        $user->setPassword($hashedPassword);
        $user->setToken(null);
        $user->setExpiresAt(null);
        $this->em->flush();

        return [];
    }
}
