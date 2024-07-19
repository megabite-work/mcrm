<?php

namespace App\Dto\Auth;

use Symfony\Component\Serializer\Attribute\Groups;

final class RefreshTokenDto
{
    public function __construct(
        #[Groups(['user:write'])]
        private string $refresh_token
    ) {
    }

    public function getRefreshToken(): ?string
    {
        return $this->refresh_token;
    }
}
