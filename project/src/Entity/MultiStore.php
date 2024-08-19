<?php

namespace App\Entity;

use App\Repository\MultiStoreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MultiStoreRepository::class)]
#[ORM\Table(name: 'multi_store')]
#[Gedmo\SoftDeleteable]
class MultiStore
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['multi_stores:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['multi_stores:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['multi_stores:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
    private ?string $profit = null;

    #[ORM\Column(name: 'barcode_TTN', nullable: true, type: Types::BIGINT, options: ['default' => 5752022000000])]
    #[Groups(['multi_stores:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
    private ?int $barcodeTtn = 5752022000000;

    #[ORM\Column(name: 'nds', nullable: true)]
    #[Groups(['multi_stores:index', 'multi_store:show', 'multi_store:create', 'multi_store:update', 'user:me'])]
    private ?int $nds = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['multi_store:show', 'multi_store:update'])]
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'multiStores')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    #[ORM\OneToMany(targetEntity: Store::class, mappedBy: 'multiStore', orphanRemoval: true)]
    #[Groups(['multi_store:show'])]
    private Collection $stores;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'multiStore')]
    #[Groups(['multi_store:show', 'multi_store:update'])]
    private Collection $phones;

    #[ORM\OneToMany(targetEntity: Nomenclature::class, mappedBy: 'multiStore')]
    private Collection $nomenclatures;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'workPlaces')]
    private Collection $workers;

    #[ORM\ManyToMany(targetEntity: CounterPart::class, inversedBy: 'multiStore')]
    private Collection $counterParts;

    public function __construct()
    {
        $this->stores = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->workers = new ArrayCollection();
        $this->counterParts = new ArrayCollection();
        $this->nomenclatures = new ArrayCollection();
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

    public function getProfit(): ?string
    {
        return $this->profit;
    }

    public function setProfit(?string $profit): static
    {
        $this->profit = $profit;

        return $this;
    }

    public function getBarcodeTtn(): ?int
    {
        return $this->barcodeTtn;
    }

    public function setBarcodeTtn(?int $barcodeTtn): static
    {
        $this->barcodeTtn = $barcodeTtn;

        return $this;
    }

    public function getNds(): ?int
    {
        return $this->nds;
    }

    public function setNds(?int $nds): static
    {
        $this->nds = $nds;

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

    public function getStores(): Collection
    {
        return $this->stores;
    }

    #[Groups(['multi_stores:index'])]
    public function getStoresCount(): ?int
    {
        return count($this->getStores());
    }

    public function addStore(Store $store): static
    {
        if (!$this->stores->contains($store)) {
            $this->stores->add($store);
            $store->setMultiStore($this);
        }

        return $this;
    }

    public function removeStore(Store $store): static
    {
        if ($this->stores->removeElement($store)) {
            if ($store->getMultiStore() === $this) {
                $store->setMultiStore(null);
            }
        }

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
            $phone->setMultiStore($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getMultiStore() === $this) {
                $phone->setMultiStore(null);
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

    public function getNomenclatures(): ?Collection
    {
        return $this->nomenclatures;
    }

    public function addNomenclature(Nomenclature $nomenclature): static
    {
        if (!$this->nomenclatures->contains($nomenclature)) {
            $this->nomenclatures->add($nomenclature);
            $nomenclature->setMultiStore($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): static
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            if ($nomenclature->getMultiStore() === $this) {
                $nomenclature->setMultiStore(null);
            }
        }

        return $this;
    }

    public function getWorkers(): Collection
    {
        return $this->workers;
    }

    #[Groups(['multi_stores:index'])]
    public function getWorkersCount(): ?int
    {
        return count($this->getWorkers());
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

    public function getCounterParts(): Collection
    {
        return $this->counterParts;
    }

    public function addCounterPart(CounterPart $counterPart): static
    {
        if (!$this->counterParts->contains($counterPart)) {
            $this->counterParts->add($counterPart);
            $counterPart->setMultiStore($this);
        }

        return $this;
    }

    public function removeCounterPart(CounterPart $counterPart): static
    {
        if ($this->counterParts->removeElement($counterPart)) {
            if ($counterPart->getMultiStore() === $this) {
                $counterPart->setMultiStore(null);
            }
        }

        return $this;
    }
}
