<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserCredentialRepository;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserCredentialRepository::class)]
#[ORM\Table(name: 'user_credential')]
#[ApiResource(
    normalizationContext: ['groups' => ['credential:read']],
    denormalizationContext: ['groups' => ['credential:write', 'credential:update']]
)]
final class UserCredential
{
    use TimestampableEntity, SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['credential:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id')]
    #[Groups(['credential:read', 'credential:write'])]
    private ?int $userId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['credential:read', 'credential:write'])]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['credential:read', 'credential:write'])]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
