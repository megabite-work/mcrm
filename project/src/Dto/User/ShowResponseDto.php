<?php

namespace App\Dto\User;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\Common\Collections\Collection;

final class ShowResponseDto
{
    private int $id;
    private string $email;
    private string $username;
    private string $qrCode;
    private array $roles;
    private ?Collection $phones;
    private ?Address $address;

    public function __construct(User $user)
    {
        $this->id = $user->getId();
        $this->email = $user->getEmail();
        $this->username = $user->getUsername();
        $this->qrCode = $user->getQrCode();
        $this->roles = $user->getRoles();
        $this->phones = $user->getPhones();
        $this->address = $user->getAddress();
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

    public function getPhones(): ?Collection
    {
        return $this->phones;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }
}
