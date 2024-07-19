<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UnitRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UnitRepository::class)]
#[ORM\Table(name: 'unit')]
#[ApiResource(
    normalizationContext: ['groups' => ['unit:read']],
    denormalizationContext: ['groups' => ['unit:write', 'unit:update']]
)]
final class Unit
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['unit:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['unit:read', 'unit:write'])]
    private ?string $name = null;

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
}
