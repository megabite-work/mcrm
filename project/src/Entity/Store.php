<?php

namespace App\Entity;

use App\Repository\StoreRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: StoreRepository::class)]
#[ORM\Table(name: 'store')]
#[Gedmo\SoftDeleteable]
class Store
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['store:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'multi_store_id')]
    #[Groups(['store:read', 'store:write'])]
    private ?int $multiStoreId = null;

    #[ORM\Column()]
    #[Groups(['store:read', 'store:write'])]
    private ?string $name = null;

    #[ORM\Column()]
    #[Groups(['store:read', 'store:write'])]
    private ?int $isActive = null;

    #[ORM\Column(name: 'official_address')]
    #[Groups(['store:read', 'store:write'])]
    private ?string $officialAddress = null;

    #[ORM\Column(name: 'coordinate')]
    #[Groups(['store:read', 'store:write'])]
    private ?string $coordinate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOfficialAddress(): ?string
    {
        return $this->officialAddress;
    }

    public function setOfficialAddress(string $officialAddress): static
    {
        $this->officialAddress = $officialAddress;

        return $this;
    }

    public function getCoordinate(): ?string
    {
        return $this->coordinate;
    }

    public function setCoordinate(string $coordinate): static
    {
        $this->coordinate = $coordinate;

        return $this;
    }
}
