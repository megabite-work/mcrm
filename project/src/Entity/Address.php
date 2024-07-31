<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AddressRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
#[ORM\Table(name: 'address')]
#[Gedmo\SoftDeleteable]
class Address
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $region = null;

    #[ORM\Column(length: 255)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $district = null;

    #[ORM\Column(length: 255)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $street = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $house = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['address:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $longitude = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(string $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function setHouse(?string $house): static
    {
        $this->house = $house;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }
}
