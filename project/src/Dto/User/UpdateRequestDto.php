<?php

namespace App\Dto\User;

final class UpdateRequestDto
{
    public function __construct(
        private ?string $email = null,
        private ?string $password = null,
        private ?string $phone = null
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
