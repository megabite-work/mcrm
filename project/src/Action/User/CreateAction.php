<?php

namespace App\Action\User;

use App\Entity\User;
use App\Dto\User\RequestDto;
use Doctrine\ORM\EntityManagerInterface;
use App\Component\EntityNotFoundException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;

class CreateAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $handler
    ) {
    }

    public function __invoke(RequestDto $dto): array
    {
        $isUniqueEmail = $this->em->getRepository(User::class)->isUniqueEmail($dto->getEmail());
        $isUniqueUsername = $this->em->getRepository(User::class)->isUniqueUsername($dto->getUsername());
        
        if (!$isUniqueEmail || !$isUniqueUsername) {
            throw new EntityNotFoundException('this email or username already exists', 400);
        }
        
        $user = (new User())
            ->setEmail($dto->getEmail())
            ->setUsername($dto->getUsername())
            ->setRoles(['ROLE_DIRECTOR']);

        $this->hashPassword($user, $dto->getPassword());
        $this->setQrCode($user, $dto->getEmail());

        $this->em->persist($user);
        $this->em->flush();

        $tokens = json_decode($this->handler->handleAuthenticationSuccess($user)->getContent(), true);

        return compact('user', 'tokens');
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
