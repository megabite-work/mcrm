<?php

namespace App\Dto\User;

use App\Entity\User;
use Symfony\Component\Serializer\Attribute\Groups;

final class ResponseDto
{
    public function __construct(
        #[Groups(['auth:read', 'user:read', 'user_show_me:read'])]
        private User $user,
        #[Groups(['auth:read'])]
        private array $tokens = []
    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTokens(): ?array
    {
        return $this->tokens;
    }
}
