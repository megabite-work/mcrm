<?php

namespace App\Entity;

use App\Repository\StoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

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

    #[ORM\ManyToOne(inversedBy: 'stores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'store')]
    #[Groups(['store:read', 'multi_store:read'])]
    private Collection $phones;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['store:read', 'multi_store:read'])]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'stores')]
    private Collection $workers;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->workers = new ArrayCollection();
    }

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

    public function getMultiStore(): ?MultiStore
    {
        return $this->multiStore;
    }

    public function setMultiStore(?MultiStore $multiStore): static
    {
        $this->multiStore = $multiStore;

        return $this;
    }

    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): static
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
            $phone->setStore($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getStore() === $this) {
                $phone->setStore(null);
            }
        }

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    public function addWorker(User $worker): static
    {
        if (!$this->workers->contains($worker)) {
            $this->workers->add($worker);
        }

        return $this;
    }

    public function removeWorker(User $worker): static
    {
        $this->workers->removeElement($worker);

        return $this;
    }
}
