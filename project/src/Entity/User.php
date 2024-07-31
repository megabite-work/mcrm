<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_NAME', fields: ['username'])]
#[Gedmo\SoftDeleteable]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['user:read', 'multi_store:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email]
    #[Assert\NotBlank]
    #[Groups(['user:read', 'multi_store:read'])]
    private ?string $email = null;

    #[ORM\Column(unique: true)]
    #[Groups(['user:read', 'multi_store:read'])]
    #[Assert\NotBlank]
    private ?string $username = null;

    #[ORM\Column(name: 'qr_code', nullable: true)]
    #[Groups(['user:read', 'multi_store:read'])]
    private ?string $qrCode = null;

    #[ORM\Column]
    #[Groups(['user:read', 'multi_store:read'])]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(targetEntity: MultiStore::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $multiStores;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'owner')]
    #[Groups(['user:read'])]
    private Collection $phones;

    #[ORM\OneToMany(targetEntity: UserCredential::class, mappedBy: 'owner', orphanRemoval: true)]
    private Collection $userCredentials;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['user:read'])]
    private ?Address $address = null;

    #[ORM\ManyToMany(targetEntity: Store::class, mappedBy: 'workers')]
    private Collection $stores;

    public function __construct()
    {
        $this->multiStores = new ArrayCollection();
        $this->phones = new ArrayCollection();
        $this->userCredentials = new ArrayCollection();
        $this->stores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getQrCode(): string
    {
        return $this->qrCode;
    }

    public function setQrCode(string $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getMultiStores(): Collection
    {
        return $this->multiStores;
    }

    public function addMultiStore(MultiStore $multiStore): static
    {
        if (!$this->multiStores->contains($multiStore)) {
            $this->multiStores->add($multiStore);
            $multiStore->setOwner($this);
        }

        return $this;
    }

    public function removeMultiStore(MultiStore $multiStore): static
    {
        if ($this->multiStores->removeElement($multiStore)) {
            if ($multiStore->getOwner() === $this) {
                $multiStore->setOwner(null);
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
            $phone->setOwner($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            if ($phone->getOwner() === $this) {
                $phone->setOwner(null);
            }
        }

        return $this;
    }

    public function getUserCredentials(): Collection
    {
        return $this->userCredentials;
    }

    public function addUserCredential(UserCredential $userCredential): static
    {
        if (!$this->userCredentials->contains($userCredential)) {
            $this->userCredentials->add($userCredential);
            $userCredential->setOwner($this);
        }

        return $this;
    }

    public function removeUserCredential(UserCredential $userCredential): static
    {
        if ($this->userCredentials->removeElement($userCredential)) {
            if ($userCredential->getOwner() === $this) {
                $userCredential->setOwner(null);
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

    public function getStores(): Collection
    {
        return $this->stores;
    }

    public function addStore(Store $store): static
    {
        if (!$this->stores->contains($store)) {
            $this->stores->add($store);
            $store->addWorker($this);
        }

        return $this;
    }

    public function removeStore(Store $store): static
    {
        if ($this->stores->removeElement($store)) {
            $store->removeWorker($this);
        }

        return $this;
    }
}
