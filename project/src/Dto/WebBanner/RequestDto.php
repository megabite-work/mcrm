<?php

namespace App\Dto\WebBanner;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_banner:create'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        private ?int $multiStoreId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        private ?string $type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        private ?int $typeId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        private ?string $image,
        #[Groups(['web_banner:update'])]
        #[Assert\Type('bool', groups: ['web_banner:update'])]
        private ?bool $isActive = true
    ) {}

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }
}
