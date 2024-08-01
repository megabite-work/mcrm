<?php

namespace App\Entity;

use App\Repository\WebNomenclatureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebNomenclatureRepository::class)]
#[ORM\Table(name: 'web_nomenclature')]
#[Gedmo\SoftDeleteable]
class WebNomenclature
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_nomenclature:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'multi_store_id')]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(name: 'web_category_id')]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?int $webCategoryId = null;

    #[ORM\Column(name: 'nomenclature_id')]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?int $nomenclatureId = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?string $article = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?string $document = null;

    #[ORM\Column(name: 'is_active')]
    #[Groups(['web_nomenclature:read', 'web_nomenclature:write'])]
    private ?int $isActive = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getWebCategoryId(): ?int
    {
        return $this->webCategoryId;
    }

    public function setWebCategoryId(int $webCategoryId): static
    {
        $this->webCategoryId = $webCategoryId;

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

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->isActive;
    }

    public function setIsActive(int $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
