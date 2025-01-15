<?php

namespace App\Entity;

use App\Repository\WebFooterLinkRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebFooterLinkRepository::class)]
class WebFooterLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?int $webFooterId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?string $type = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?bool $isActive = true;

    #[ORM\Column(length: 255)]
    #[Groups(['web_footer_link:index', 'web_footer_link:show', 'web_footer_link:create', 'web_footer_link:update'])]
    private ?string $link = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebFooterId(): ?int
    {
        return $this->webFooterId;
    }

    public function setWebFooterId(?int $webFooterId): static
    {
        $this->webFooterId = $webFooterId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }
}
