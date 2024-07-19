<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ForgiveTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ForgiveTypeRepository::class)]
#[ORM\Table(name: 'forgive_type')]
#[ApiResource(
    normalizationContext: ['groups' => ['forgive_type:read']],
    denormalizationContext: ['groups' => ['forgive_type:write', 'forgive_type:update']]
)]
final class ForgiveType
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['forgive_type:read'])]
    private ?int $id = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['forgive_type:read', 'forgive_type:write'])]
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