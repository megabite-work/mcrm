<?php

namespace App\Action\User;

use App\Dto\ForgotPassword\RequestDto;
use App\Entity\User;
use App\Exception\ErrorException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
    ) {}

    public function __invoke(string $token, RequestDto $dto): void
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['token' => $token]);

        if ($user->isTokenExpired()) {
            return throw new ErrorException('User', 'token is expired', Response::HTTP_BAD_REQUEST);
        }

        $hashedPassword = $this->passwordHasher->hashPassword($user, $dto->password);
        $user->setPassword($hashedPassword);
        $user->setToken(null);
        $user->setExpiresAt(null);
        $this->em->flush();
    }
}
