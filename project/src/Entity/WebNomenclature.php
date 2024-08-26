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
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Nomenclature::class, inversedBy: 'webNomenclature')]
    #[ORM\JoinColumn(name: 'nomenclature_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?Nomenclature $nomenclature = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $article = null;

    #[ORM\Column]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $images = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?string $document = null;

    #[ORM\Column(name: 'is_active', options: ['default' => true])]
    #[Groups(['web_nomenclature:index', 'web_nomenclature:show', 'web_nomenclature:create', 'web_nomenclature:update'])]
    private ?bool $isActive = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomenclature(): ?Nomenclature
    {
        return $this->nomenclature;
    }

    public function setNomenclature(Nomenclature $nomenclature): static
    {
        $this->nomenclature = $nomenclature;

        return $this;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function setArticle(?string $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getImages(): ?array
    {
        return json_decode($this->images, true);
    }

    public function setImages(?array $images): static
    {
        $this->images = json_encode($images, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
