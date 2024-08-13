<?php

namespace App\Action\User;

use App\Component\EntityNotFoundException;
use App\Dto\User\RequestDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em
    ) {
    }

    public function __invoke(RequestDto $dto): User
    {
        $isUniqueEmail = $this->em->getRepository(User::class)->isUniqueEmail($dto->getEmail());
        $isUniqueUsername = $this->em->getRepository(User::class)->isUniqueUsername($dto->getUsername());
        
        if (!$isUniqueEmail || !$isUniqueUsername) {
            throw new EntityNotFoundException('this email or username already exists', 400);
        }

        $user = (new User())
            ->setEmail($dto->getEmail())
            ->setUsername($dto->getUsername());

        $this->hashPassword($user, $dto->getPassword());
        $this->setQrCode($user, $dto->getEmail());

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    private function hashPassword(User $user, string $password): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
    }

    private function setQrCode(User $user, string $data): void
    {
        $qrCode = base64_encode($data);
        $user->setQrCode($qrCode);
    }
}
