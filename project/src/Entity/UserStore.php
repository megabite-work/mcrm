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
    normalizationContext: ['groups' => ['user_store:read']],
    denormalizationContext: ['groups' => ['user_store:write', 'user_store:update']]
)]
final class UserStore
{
    use TimestampableEntity, SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user_store:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'user_id')]
    #[Groups(['user_store:read', 'user_store:write'])]
    private ?int $userId = null;

    #[ORM\Column(name: 'store_id')]
    #[Groups(['user_store:read', 'user_store:write'])]
    private ?int $storeId = null;

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

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): static
    {
        $this->storeId = $storeId;

        return $this;
    }
}
