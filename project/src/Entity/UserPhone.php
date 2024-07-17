<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserPhoneRepository;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserPhoneRepository::class)]
#[ORM\Table(name: 'user_phone')]
#[ApiResource(
    normalizationContext: ['groups' => ['phone:read']],
    denormalizationContext: ['groups' => ['phone:write', 'phone:update']]
)]
final class UserPhone
{
    use TimestampableEntity, SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['phone:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['phone:read', 'phone:write'])]
    private ?int $user_id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['phone:read', 'phone:write'])]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    #[Groups(['phone:read', 'phone:write'])]
    private ?string $type = null;

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

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

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
}
