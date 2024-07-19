<?php

declare(strict_types=1);

namespace App\Component;

use App\Entity\User;
use App\Component\AuthException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CurrentUser
{
    public function __construct(private TokenStorageInterface $tokenStorage)
    {
    }

    public function getUser(): User
    {
        $user = $this->getToken()->getUser();

        if (!$user instanceof User) {
            throw new AuthException('User is not found');
        }

        return $user;
    }

    public function isAuthed(): bool
    {
        return $this->tokenStorage->getToken() !== null;
    }

    private function getToken(): TokenInterface
    {
        $token = $this->tokenStorage->getToken();

        if ($token === null) {
            throw new AuthException('You should be authorized');
        }

        return $token;
    }
}
