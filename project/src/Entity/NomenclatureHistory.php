<?php

namespace App\Entity;

use App\Repository\NomenclatureHistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: NomenclatureHistoryRepository::class)]
#[ORM\Table(name: 'nomenclature_history')]
#[Gedmo\SoftDeleteable]
class NomenclatureHistory
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['nomenclature_history:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Store::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'store_id', referencedColumnName: 'id')]
    private ?Store $store = null;

    #[ORM\ManyToOne(targetEntity: Nomenclature::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id')]
    private ?Nomenclature $nomenclature = null;

    #[ORM\ManyToOne(targetEntity: ForgiveType::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'forgive_type_id', referencedColumnName: 'id')]
    private ?ForgiveType $forgiveType = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'nomenclatureHistories')]
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    private ?User $owner = null;

    #[ORM\Column]
    #[Groups(['nomenclature_history:read'])]
    private ?string $comment = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature_history:read'])]
    private ?string $qty = null;

    #[ORM\Column(name: 'oldprice', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature_history:read'])]
    private ?string $oldPrice = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature_history:read'])]
    private ?string $price = null;

    #[ORM\Column(name: 'oldprice_course', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature_history:read'])]
    private ?string $oldPriceCourse = null;

    #[ORM\Column(name: 'price_course', type: 'decimal', precision: 10, scale: 2)]
    #[Groups(['nomenclature_history:read'])]
    private ?string $priceCourse = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStore(): ?Store
    {
        return $this->store;
    }

    public function setStore(?Store $store): static
    {
        $this->store = $store;

        return $this;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclature(?Nomenclature $nomenclature): static
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    public function getForgiveType(): ?ForgiveType
    {
        return $this->forgiveType;
    }

    public function setForgiveType(?ForgiveType $forgiveType): static
    {
        $this->forgiveType = $forgiveType;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

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

    public function getOldPrice(): ?string
    {
        return $this->oldPrice;
    }

    public function setOldPrice(string $oldPrice): static
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getOldPriceCourse(): ?string
    {
        return $this->oldPriceCourse;
    }

    public function setOldPriceCourse(string $oldPriceCourse): static
    {
        $this->oldPriceCourse = $oldPriceCourse;

        return $this;
    }

    public function getPriceCourse(): ?string
    {
        return $this->priceCourse;
    }

    public function setPriceCourse(string $priceCourse): static
    {
        $this->priceCourse = $priceCourse;

        return $this;
    }
}
