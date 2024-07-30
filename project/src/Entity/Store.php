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
    #[Groups(['store:read', 'multi_store:read'])]
    private ?int $id = null;

    #[ORM\Column()]
    #[Groups(['store:read', 'multi_store:read'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['store:read', 'multi_store:read'])]
    private bool $isActive = true;

    #[ORM\Column(name: 'official_address', nullable: true)]
    #[Groups(['store:read', 'multi_store:read'])]
    private ?string $officialAddress = null;

    #[ORM\Column(name: 'coordinate', nullable: true)]
    #[Groups(['store:read', 'multi_store:read'])]
    private ?string $coordinate = null;

    #[ORM\ManyToOne(inversedBy: 'stores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
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

    public function getMultiStore(): ?MultiStore
    {
        return $this->multiStore;
    }

    public function setMultiStore(?MultiStore $multiStore): static
    {
        $this->multiStore = $multiStore;

        return $this;
    }
}
