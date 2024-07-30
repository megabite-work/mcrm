<?php

namespace App\Entity;

use App\Repository\NomenclatureHistoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

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

    #[ORM\Column(name: 'store_id')]
    #[Groups(['nomenclature_history:read'])]
    private ?int $storeId = null;

    #[ORM\Column(name: 'nomenclature_id')]
    #[Groups(['nomenclature_history:read'])]
    private ?int $nomenclatureId = null;

    #[ORM\Column(name: 'nomenclature_history_id')]
    #[Groups(['nomenclature_history:read'])]
    private ?int $forgiveTypeId = null;

    #[ORM\Column(name: 'user_id')]
    #[Groups(['nomenclature_history:read'])]
    private ?int $userId = null;

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

    public function getForgiveTypeId(): ?int
    {
        return $this->forgiveTypeId;
    }

    public function setForgiveTypeId(int $forgiveTypeId): static
    {
        $this->forgiveTypeId = $forgiveTypeId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): static
    {
        $this->userId = $userId;

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
