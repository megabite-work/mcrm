<?php

namespace App\Entity;

use App\Repository\ProviderListRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProviderListRepository::class)]
#[ORM\Table(name: 'provider_list')]
final class ProviderList
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['provider_list:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['provider_list:read', 'provider_list:write'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['provider_list:read', 'provider_list:write'])]
    private ?string $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getvalue(): ?string
    {
        return $this->value;
    }

    public function setvalue(string $value): static
    {
        $this->value = $value;

        return $this;
    }
}
