<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserSecurityRepository;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserSecurityRepository::class)]
#[ORM\Table(name: 'user_security')]
#[ApiResource(
    normalizationContext: ['groups' => ['security:read']],
    denormalizationContext: ['groups' => ['security:write', 'security:update']]
)]
final class UserSecurity
{
    use TimestampableEntity, SoftDeleteableEntity;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['security:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['security:read', 'security:write'])]
    private ?int $user_id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['security:read', 'security:write'])]
    private ?string $ip = null;

    #[ORM\Column]
    #[Groups(['security:read', 'security:write'])]
    private ?int $security = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getSecurity(): ?int
    {
        return $this->security;
    }

    public function setSecurity(int $security): static
    {
        $this->security = $security;

        return $this;
    }
}
