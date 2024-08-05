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
    #[Groups(['nomenclature:index'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: MultiStore::class, inversedBy: 'webNomenclatures')]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?MultiStore $multiStore = null;

    #[ORM\OneToOne(targetEntity: Nomenclature::class)]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id')]
    private ?Nomenclature $nomenclature = null;

    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?string $article = null;

    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?string $title = null;

    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?string $document = null;

    #[ORM\Column(name: 'is_active')]
    #[Groups(['nomenclature:index', 'nomenclature:create'])]
    private ?bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStore(): ?MultiStore
    {
        return $this->multiStore;
    }

    public function setMultiStore(?MultiStore $multiStore): static
    {
        $this->multiStore = $multiStore;

        return $this;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclatureId(Nomenclature $nomenclature): static
    {
        $this->nomenclature = $nomenclature;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
