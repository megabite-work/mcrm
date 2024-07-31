<?php

namespace App\Dto\User;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateRequestDto
{
    public function __construct(
        #[Assert\Email]
        #[Assert\NotBlank]
        private string $email,
        #[Assert\NotBlank]
        #[Assert\Length(min: 3)]
        private string $username,
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        private string $password,
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
}
