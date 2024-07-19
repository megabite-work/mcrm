<?php

namespace App\Dto\User;

use App\Entity\User;
use Symfony\Component\Serializer\Attribute\Groups;

final class CreateResponseDto
{
    public function __construct(
        #[Groups(['user:read'])]
        private User $user,
        #[Groups(['user:read'])]
        private array $tokens
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTokens(): array
    {
        return $this->tokens;
    }
}
