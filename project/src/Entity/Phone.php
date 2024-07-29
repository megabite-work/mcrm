<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
#[ORM\Table(name: 'user_phone')]
#[Gedmo\SoftDeleteable]
class Phone
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public const PHONE_COUNTER_PART = 'counter_part';
    public const PHONE_MULTI_STORE = 'multi_store';
    public const PHONE_STORE = 'store';
    public const PHONE_USER = 'user';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['phone:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'phoneble_id')]
    #[Groups(['phone:read', 'phone:write'])]
    private ?int $phonebleId = null;

    #[ORM\Column(length: 255)]
    #[Groups(['phone:read', 'phone:write'])]
    private ?string $phone = null;

    #[ORM\Column(name: 'phoneble_type', length: 255)]
    #[Groups(['phone:read', 'phone:write'])]
    private ?string $phonebleType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhonebleId(): ?int
    {
        return $this->phonebleId;
    }

    public function setPhonebleId(int $phonebleId): static
    {
        $this->phonebleId = $phonebleId;

        return $this;
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

    public function getPhonebleType(): ?string
    {
        return $this->phonebleType;
    }

    public function setPhonebleType(string $phonebleType): static
    {
        $this->phonebleType = $phonebleType;

        return $this;
    }
}
