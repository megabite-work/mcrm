<?php

namespace App\Entity;

use App\Repository\UserStoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: UserStoreRepository::class)]
#[ORM\Table(name: 'user_store')]
#[Gedmo\SoftDeleteable]
final class UserStore
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

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
