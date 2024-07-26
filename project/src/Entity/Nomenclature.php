<?php

namespace App\Entity;

use App\Repository\NomenclatureRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: NomenclatureRepository::class)]
#[ORM\Table(name: 'nomenclature')]
#[Gedmo\SoftDeleteable]
final class Nomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nomenclature:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'category_id')]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?int $categoryId = null;

    #[ORM\Column(name: 'unit_id')]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?int $unitId = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $mxik = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $barcode = null;

    #[ORM\Column]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $brand = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $name = null;

    #[ORM\Column(name: 'oldprice', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $oldPrice = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $price = null;

    #[ORM\Column(name: 'oldprice_course', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $oldPriceCourse = null;

    #[ORM\Column(name: 'price_course', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $priceCourse = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $nds = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?string $discount = null;

    #[ORM\Column(name: 'provider_id')]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?int $providerId = null;

    #[ORM\Column(name: 'qr_code')]
    #[Groups(['nomenclature:read', 'nomenclature:write'])]
    private ?int $qrCode = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMxik(): ?string
    {
        return $this->mxik;
    }

    public function setMxik(?string $mxik): self
    {
        $this->mxik = $mxik;

        return $this;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(?string $barcode): self
    {
        $this->barcode = $barcode;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(?int $categoryId): self
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUnitId(): ?int
    {
        return $this->unitId;
    }

    public function setUnitId(?int $unitId): self
    {
        $this->unitId = $unitId;

        return $this;
    }

    public function getOldPrice(): ?string
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?string $oldPrice): self
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getOldPriceCourse(): ?string
    {
        return $this->oldPriceCourse;
    }

    public function setOldPriceCourse(?string $oldPriceCourse): self
    {
        $this->oldPriceCourse = $oldPriceCourse;

        return $this;
    }

    public function getPriceCourse(): ?string
    {
        return $this->priceCourse;
    }

    public function setPriceCourse(?string $priceCourse): self
    {
        $this->priceCourse = $priceCourse;

        return $this;
    }

    public function getNds(): ?string
    {
        return $this->nds;
    }

    public function setNds(?string $nds): self
    {
        $this->nds = $nds;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    public function setProviderId(?int $providerId): self
    {
        $this->providerId = $providerId;

        return $this;
    }

    public function getQrCode(): ?int
    {
        return $this->qrCode;
    }

    public function setQrCode(?int $qrCode): self
    {
        $this->qrCode = $qrCode;

        return $this;
    }
}
