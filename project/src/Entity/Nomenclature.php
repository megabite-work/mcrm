<?php

namespace App\Entity;

use App\Repository\NomenclatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NomenclatureRepository::class)]
#[ORM\Table(name: 'nomenclature')]
#[Gedmo\SoftDeleteable]
class Nomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nomenclature:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read'])]
    private ?string $mxik = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read'])]
    private ?string $barcode = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read'])]
    private ?string $brand = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['nomenclature:read'])]
    private ?string $name = null;

    #[ORM\Column(name: 'oldprice', type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $oldPrice = null;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $price = null;

    #[ORM\Column(name: 'oldprice_course', type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $oldPriceCourse = null;

    #[ORM\Column(name: 'price_course', type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $priceCourse = null;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $nds = null;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 3)]
    #[Groups(['nomenclature:read'])]
    private ?float $discount = null;

    #[ORM\Column(name: 'qr_code')]
    #[Groups(['nomenclature:read'])]
    private ?string $qrCode = null;

    #[ORM\ManyToOne(targetEntity: ProviderList::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'provider_id', referencedColumnName: 'id', nullable: true)]
    private ?ProviderList $provider = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ?Category $category = null;

    #[ORM\ManyToOne(targetEntity: Unit::class, inversedBy: 'nomenclatures')]
    #[ORM\JoinColumn(name: 'unit_id', referencedColumnName: 'id')]
    private ?Unit $unit = null;

    #[ORM\OneToMany(targetEntity: NomenclatureHistory::class, mappedBy: 'nomenclature')]
    private Collection $nomenclatureHistories;

    #[ORM\OneToMany(targetEntity: StoreNomenclature::class, mappedBy: 'nomenclature')]
    private Collection $storeNomenclatures;

    public function __construct()
    {
        $this->nomenclatureHistories = new ArrayCollection();
        $this->storeNomenclatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMxik(): ?string
    {
        return $this->mxik;
    }

    public function setMxik(?string $mxik): static
    {
        $this->mxik = $mxik;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?float $oldPrice): static
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOldPriceCourse(): ?float
    {
        return $this->oldPriceCourse;
    }

    public function setOldPriceCourse(?float $oldPriceCourse): static
    {
        $this->oldPriceCourse = $oldPriceCourse;

        return $this;
    }

    public function getPriceCourse(): ?float
    {
        return $this->priceCourse;
    }

    public function setPriceCourse(?float $priceCourse): static
    {
        $this->priceCourse = $priceCourse;

        return $this;
    }

    public function getNds(): ?float
    {
        return $this->nds;
    }

    public function setNds(?float $nds): static
    {
        $this->nds = $nds;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): static
    {
        $this->discount = $discount;

        return $this;
    }

    public function getProvider(): ?ProviderList
    {
        return $this->provider;
    }

    public function setProvider(?ProviderList $provider): static
    {
        $this->provider = $provider;

        return $this;
    }

    public function getQrCode(): ?string
    {
        return $this->qrCode;
    }

    public function setQrCode(?string $qrCode): static
    {
        $this->qrCode = $qrCode;

        return $this;
    }

    public function getNomenclatureHistories(): ?Collection
    {
        return $this->nomenclatureHistories;
    }

    public function addNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if (!$this->nomenclatureHistories->contains($nomenclatureHistory)) {
            $this->nomenclatureHistories->add($nomenclatureHistory);
            $nomenclatureHistory->setNomenclature($this);
        }

        return $this;
    }

    public function removeNomenclatureHistory(NomenclatureHistory $nomenclatureHistory): static
    {
        if ($this->nomenclatureHistories->removeElement($nomenclatureHistory)) {
            if ($nomenclatureHistory->getNomenclature() === $this) {
                $nomenclatureHistory->setNomenclature(null);
            }
        }

        return $this;
    }

    public function getStoreNomenclatures(): ?Collection
    {
        return $this->storeNomenclatures;
    }

    public function addStoreNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if (!$this->storeNomenclatures->contains($storeNomenclature)) {
            $this->storeNomenclatures->add($storeNomenclature);
            $storeNomenclature->setNomenclature($this);
        }

        return $this;
    }

    public function removeNomenclature(StoreNomenclature $storeNomenclature): static
    {
        if ($this->storeNomenclatures->removeElement($storeNomenclature)) {
            if ($storeNomenclature->getNomenclature() === $this) {
                $storeNomenclature->setNomenclature(null);
            }
        }

        return $this;
    }
}
