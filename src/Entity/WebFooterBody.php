<?php

namespace App\Entity;

use App\Repository\WebFooterBodyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebFooterBodyRepository::class)]
class WebFooterBody
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_footer_body:index', 'web_footer_body:show', 'web_footer_body:create', 'web_footer_body:update'])]
    private ?int $webFooterId = null;

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
}
