<?php

namespace App\Entity;

use App\Repository\StoreNomenclatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: StoreNomenclatureRepository::class)]
#[ORM\Table(name: 'store_nomenclature')]
#[Gedmo\SoftDeleteable]
class StoreNomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['store_nomenclature:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'store_id')]
    #[Groups(['store_nomenclature:read', 'store_nomenclature:write'])]
    private ?int $storeId = null;

    #[ORM\Column(name: 'nomenclature_id')]
    #[Groups(['store_nomenclature:read', 'store_nomenclature:write'])]
    private ?int $nomenclatureId = null;

    #[ORM\Column(name: 'qty', type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['store_nomenclature:read', 'store_nomenclature:write'])]
    private ?string $qty = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    public function setStoreId(int $storeId): static
    {
        $this->storeId = $storeId;

        return $this;
    }

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function setNomenclatureId(int $nomenclatureId): static
    {
        $this->nomenclatureId = $nomenclatureId;

        return $this;
    }

    public function getQty(): ?string
    {
        return $this->qty;
    }

    public function setQty(string $qty): static
    {
        $this->qty = $qty;

        return $this;
    }
}
