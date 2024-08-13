<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'category')]
#[Gedmo\SoftDeleteable]
class Category
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:index', 'category:show', 'category:create', 'category:update', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show'])]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'childrens')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true)]
    private ?Category $parent = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['category:index', 'category:show', 'category:create', 'category:update', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show', 'nomenclature_history:index', 'nomenclature_history:show', 'nomenclature_history:create'])]
    private ?array $name = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['category:index', 'category:show', 'category:create', 'category:update', 'nomenclature:show', 'store_nomenclature:index', 'store_nomenclature:show', 'web_nomenclature:index', 'web_nomenclature:show'])]
    private ?string $image = null;

    #[ORM\Column(name: 'is_active', options: ['default' => true])]
    #[Groups(['category:index', 'category:show', 'category:create', 'category:update'])]
    private ?bool $isActive = true;

    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'parent')]
    private Collection $childrens;

    #[ORM\OneToMany(targetEntity: Nomenclature::class, mappedBy: 'category')]
    private Collection $nomenclatures;

    public function __construct()
    {
        $this->childrens = new ArrayCollection();
        $this->nomenclatures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['category:index', 'category:show', 'category:create', 'category:update'])]
    public function getParentId(): ?int
    {
        return $this->parent?->getId();
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(?Category $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChildrens(): ?Collection
    {
        return $this->childrens;
    }

    public function addChildren(Category $children): static
    {
        if (!$this->childrens->contains($children)) {
            $this->childrens->add($children);
            $children->setParent($this);
        }

        return $this;
    }

    public function removeChildren(Category $children): static
    {
        if ($this->childrens->removeElement($children)) {
            if ($children->getParent() === $this) {
                $children->setParent(null);
            }
        }

        return $this;
    }

    public function getNomenclatures(): ?Collection
    {
        return $this->nomenclatures;
    }

    public function addNomenclature(Nomenclature $nomenclature): static
    {
        if (!$this->nomenclatures->contains($nomenclature)) {
            $this->nomenclatures->add($nomenclature);
            $nomenclature->setCategory($this);
        }

        return $this;
    }

    public function removeNomenclature(Nomenclature $nomenclature): static
    {
        if ($this->nomenclatures->removeElement($nomenclature)) {
            if ($nomenclature->getCategory() === $this) {
                $nomenclature->setCategory(null);
            }
        }

        return $this;
    }

    public function getName(): ?array
    {
        return $this->name;
    }

    public function setName(?array $name): static
    {
        $this->name = $name;

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
