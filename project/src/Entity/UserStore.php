<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserStoreRepository;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: UserStoreRepository::class)]
#[ORM\Table(name: 'user_store')]
#[ApiResource(
    normalizationContext: ['groups' => ['store:read']],
    denormalizationContext: ['groups' => ['store:write', 'store:update']]
)]
final class UserStore
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

    #[ORM\Column]
    #[Groups(['security:read', 'security:write'])]
    private ?int $store_id = null;

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

    public function getStoreId(): ?int
    {
        return $this->store_id;
    }

    public function setStoreId(int $store_id): static
    {
        $this->store_id = $store_id;

        return $this;
    }
}
