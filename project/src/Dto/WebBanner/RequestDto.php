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
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: ['product', 'category', 'page', 'link'], groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $typeId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $image,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $title = null,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $description,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\Count(min: 1, max: 3, groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\All(
            constraints: [new Assert\Choice(choices: ['pc', 'mobile', 'notebook'])],
            groups: ['web_banner:create', 'web_banner:update']
        )]
        private ?array $devices,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: ['off', 'unique', 'all'], groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $click_type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: ['off', 'unique', 'all'], groups: ['web_banner:create', 'web_banner:update'])]
        private ?string $view_type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?\DateTime $begin_at,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?int $click_max = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?int $click_current = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?int $view_max = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?int $view_current = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        private ?\DateTime $end_at = null,
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

    public function getTypeId(): ?string
    {
        return $this->typeId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDevices(): ?array
    {
        return $this->devices;
    }

    public function getClickType(): ?string
    {
        return $this->click_type;
    }

    public function getViewType(): ?string
    {
        return $this->view_type;
    }

    public function getBeginAt(): ?\DateTime
    {
        return $this->begin_at;
    }

    public function getClickMax(): ?int
    {
        return $this->click_max;
    }

    public function getClickCurrent(): ?int
    {
        return $this->click_current;
    }

    public function getViewMax(): ?int
    {
        return $this->view_max;
    }

    public function getViewCurrent(): ?int
    {
        return $this->view_current;
    }

    public function getEndAt(): ?\DateTime
    {
        return $this->end_at;
    }
}
