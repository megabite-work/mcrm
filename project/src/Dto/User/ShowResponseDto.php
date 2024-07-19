<?php

namespace App\Dto\User;

use App\Entity\User;

final class ShowResponseDto
{
    private int $id;
    private string $email;
    private string $username;
    private string $qrCode;
    private array $roles;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
        $this->username = $user->getUsername();
        $this->qrCode = $user->getQrCode();
        $this->roles = $user->getRoles();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
