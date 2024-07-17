<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\Serializer\Attribute\Groups;

final class TokensDto
{
    public function __construct(
        #[Groups(['user:read'])]
        private string $token,

        #[Groups(['user:read'])]
        private string $refresh_token
    ) {
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getRefreshToken(): string
    {
        return $this->refresh_token;
    }
}