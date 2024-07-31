<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ORM\Table(name: 'phone')]
#[Gedmo\SoftDeleteable]
class Phone
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['phone:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['phone:read', 'user:read', 'store:read', 'multi_store:read', 'counter_part:read'])]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    private ?User $owner = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    private ?Store $store = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    private ?MultiStore $multiStore = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    private ?CounterPart $counterPart = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): static
    {
        $this->store = $store;

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

    public function getCounterPart(): ?CounterPart
    {
        return $this->counterPart;
    }

    public function setCounterPart(?CounterPart $counterPart): static
    {
        $this->counterPart = $counterPart;

        return $this;
    }
}
