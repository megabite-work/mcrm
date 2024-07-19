<?php

namespace App\Entity;

use App\Repository\CounterPartRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CounterPartRepository::class)]
#[ORM\Table(name: 'counter_part')]
final class CounterPart
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['counter_part:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'multi_store_id')]
    #[Groups(['counter_part:read', 'counter_part:write'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(name: 'stir')]
    #[Groups(['counter_part:read', 'counter_part:write'])]
    private ?string $stir = null;

    #[ORM\Column()]
    #[Groups(['counter_part:read', 'counter_part:write'])]
    private ?string $name = null;

    #[ORM\Column()]
    #[Groups(['counter_part:read', 'counter_part:write'])]
    private ?string $address = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['counter_part:read', 'counter_part:write'])]
    private ?string $discount = null;

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

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getStir(): ?string
    {
        return $this->stir;
    }

    public function setStir(string $stir): static
    {
        $this->stir = $stir;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(string $discount): static
    {
        $this->discount = $discount;

        return $this;
    }
}
