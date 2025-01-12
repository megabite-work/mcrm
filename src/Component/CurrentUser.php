<?php

declare(strict_types=1);

namespace App\Component;

use App\Entity\User;
use App\Exception\ErrorException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CurrentUser
{
    public function __construct(
        private TokenStorageInterface $tokenStorage
    ) {}

    public function getUser(): User
    {
        $user = $this->getToken()->getUser();

        if (!$user instanceof User) {
            throw new ErrorException('User', 'not found');
        }

        return $user;
    }

    public function getId(): int
    {
        $userId = $this->getUser()->getId();

        return $userId;
    }

    public function isAuthed(): bool
    {
        return null !== $this->tokenStorage->getToken();
    }

    private function getToken(): TokenInterface
    {
        $token = $this->tokenStorage->getToken();

        if (null === $token) {
            throw new ErrorException('Authorization', 'You should be authorized');
        }

        return $token;
    }
}
