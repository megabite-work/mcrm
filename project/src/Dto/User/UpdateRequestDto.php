<?php

namespace App\Dto\User;

final class UpdateRequestDto
{
    public function __construct(
        private ?string $email = null,
        private ?string $phone = null
    ) {
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
