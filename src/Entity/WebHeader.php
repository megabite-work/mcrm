<?php

namespace App\Entity;

use App\Repository\WebHeaderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebHeaderRepository::class)]
class WebHeader
{
    public const TYPE_ABOUT = 'about';
    public const TYPE_CATEGORY = 'category';
    public const TYPE_LOGO = 'logo';
    public const TYPE_SOCIAL = 'social';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_header:index', 'web_header:show', 'web_header:create', 'web_header:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_header:index', 'web_header:show', 'web_header:create', 'web_header:update'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: [Webheader::TYPE_ABOUT, Webheader::TYPE_CATEGORY, Webheader::TYPE_LOGO, Webheader::TYPE_SOCIAL])]
    #[Groups(['web_header:index', 'web_header:show', 'web_header:create', 'web_header:update'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['web_header:index', 'web_header:show', 'web_header:create', 'web_header:update'])]
    private ?bool $isActive = false;

    #[ORM\Column]
    #[Groups(['web_header:index', 'web_header:show', 'web_header:create', 'web_header:update'])]
    private ?int $order = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(?int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getOrder(): ?int
    {
        return $this->order;
    }

    public function setOrder(?int $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
