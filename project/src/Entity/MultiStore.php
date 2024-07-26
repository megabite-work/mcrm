<?php

namespace App\Entity;

use App\Repository\MultiStoreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: MultiStoreRepository::class)]
#[ORM\Table(name: 'multi_store')]
#[Gedmo\SoftDeleteable]
final class MultiStore
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['multi_store:read'])]
    private ?int $id = null;

    #[ORM\Column()]
    #[Groups(['multi_store:read', 'multi_store:write'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['multi_store:read', 'multi_store:write'])]
    private ?string $profit = null;

    #[ORM\Column(name: 'barcode_TTN')]
    #[Groups(['multi_store:read', 'multi_store:write'])]
    private ?int $barcodeTtn = null;

    #[ORM\Column(name: 'nds')]
    #[Groups(['multi_store:read', 'multi_store:write'])]
    private ?int $nds = null;

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

    public function setProfit(string $profit): static
    {
        $this->profit = $profit;

        return $this;
    }

    public function getBarcodeTtn(): ?int
    {
        return $this->barcodeTtn;
    }

    public function setBarcodeTtn(int $barcodeTtn): static
    {
        $this->barcodeTtn = $barcodeTtn;

        return $this;
    }

    public function getNds(): ?int
    {
        return $this->nds;
    }

    public function setNds(int $nds): static
    {
        $this->nds = $nds;

        return $this;
    }
}
