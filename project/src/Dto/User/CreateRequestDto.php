<?php

namespace App\Dto\User;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateRequestDto
{
    public function __construct(
        #[Assert\Email]
        #[Assert\NotBlank]
        #[Groups(['user:write'])]
        private string $email,
        #[Assert\NotBlank]
        #[Assert\Length(min: 3)]
        #[Groups(['user:write'])]
        private string $username,
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        #[Groups(['user:write'])]
        private string $password,
        #[Groups(['user:write'])]
        private string $phone
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
