<?php

namespace App\Controller\User;

use App\Dto\User\CreateRequestDto;
use App\Dto\User\CreateResponseDto;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAction extends AbstractController
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $handler
    ) {
    }

    public function __invoke(#[MapRequestPayload] CreateRequestDto $dto): CreateResponseDto
    {
        $user = (new User())
            ->setEmail($dto->getEmail())
            ->setUsername($dto->getUsername())
            ->setRoles(['ROLE_DIRECTOR']);

        $this->hashPassword($user, $dto->getPassword());
        $this->setQrCode($user, $dto->getEmail());

        $this->em->persist($user);
        $this->em->flush();

        $tokens = json_decode($this->handler->handleAuthenticationSuccess($user)->getContent(), true);

        return new CreateResponseDto($user, $tokens);
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
