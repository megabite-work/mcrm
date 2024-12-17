<?php

namespace App\Dto\WebBanner;

use Symfony\Component\Validator\Constraints as Assert;

final class WebBannerMetrikaUpsertDto
{
    public function __construct(
        #[Assert\NotBlank]
        private int $webBannerId,
        #[Assert\NotBlank]
        private string $type,
        #[Assert\Ip(Assert\Ip::ALL)]
        private string $ip,
    ) {}

    public function getWebBannerId(): int
    {
        return $this->webBannerId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
