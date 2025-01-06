<?php

namespace App\Action\User;

use App\Dto\User\RequestDto;
use App\Entity\User;
use App\Exception\ErrorException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateUserAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $handler,
        private UserRepository $repo
    ) {}

    public function __invoke(RequestDto $dto): array
    {
        $isUniqueEmail = $this->repo->isUniqueEmail($dto->email);
        $isUniqueUsername = $this->repo->isUniqueUsername($dto->username);

        if (!$isUniqueEmail || !$isUniqueUsername) {
            throw new ErrorException('User', 'this email or username already exists', Response::HTTP_BAD_REQUEST);
        }

        $entity = (new User())
            ->setEmail($dto->email)
            ->setUsername($dto->username)
            ->setQrCode(base64_encode($dto->email));
        $this->hashPassword($entity, $dto->password);
        $this->em->persist($entity);
        $this->em->flush();

        $tokens = json_decode($this->handler->handleAuthenticationSuccess($entity)->getContent(), true);

        return compact('entity', 'tokens');
    }

    private function hashPassword(User $entity, string $password): void
    {
        $hashedPassword = $this->passwordHasher->hashPassword($entity, $password);
        $entity->setPassword($hashedPassword);
    }
}
