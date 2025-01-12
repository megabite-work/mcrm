<?php

namespace App\Action\User;

use App\Dto\User\IndexDto;
use App\Dto\User\RequestDto;
use App\Entity\MultiStore;
use App\Entity\Role;
use App\Entity\User;
use App\Exception\ErrorException;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateWorkerAction
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $em,
        private UserRepository $repo,
    ) {}

    public function __invoke(RequestDto $dto): IndexDto
    {
        $isUniqueEmail = $this->repo->isUniqueEmail($dto->email);
        $isUniqueUsername = $this->repo->isUniqueUsername($dto->username);
        $multiStore = $this->em->getReference(MultiStore::class, $dto->multiStoreId);

        if (!$isUniqueEmail || !$isUniqueUsername || null === $multiStore) {
            throw new ErrorException('User', 'this email or username already exists', Response::HTTP_BAD_REQUEST);
        }

        $entity = new User();
        $entity->setEmail($dto->email)
            ->setUsername($dto->username)
            ->addWorkPlace($multiStore)
            ->setQrCode(base64_encode($dto->email))
            ->setPassword($this->passwordHasher->hashPassword($entity, $dto->password));
        $this->setRole($entity, $dto->role);
        $this->em->persist($entity);
        $this->em->flush();

        return IndexDto::fromEntity($entity);
    }

    private function setRole(User $entity, int $role): void
    {
        $roles = array_column(Role::getRoles(), 'id');

        if (!in_array($role, $roles)) {
            throw new ErrorException('Role', 'not found', Response::HTTP_NOT_FOUND);
        }

        $entity->setRoles(Role::getRoleName($role));
    }
}
