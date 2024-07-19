<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
#[ORM\Table(name: 'currency')]
#[ApiResource(
    normalizationContext: ['groups' => ['currency:read']],
    denormalizationContext: ['groups' => ['currency:write', 'currency:update']]
)]
final class Currency
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['currency:read'])]
    private ?int $id = null;

    #[ORM\Column()]
    #[Groups(['currency:read', 'currency:write'])]
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
