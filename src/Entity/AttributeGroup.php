<?php

namespace App\Entity;

use App\Entity\AttributeEntity;
use App\Repository\AttributeGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeGroupRepository::class)]
class AttributeGroup
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: AttributeEntity::class, mappedBy: 'group')]
    private Collection $attributeEntities;

    public function __construct()
    {
        $this->attributeEntities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?array
    {
        return json_decode($this->name, true);
    }

    public function setName(array $name): static
    {
        $this->name = json_encode($name, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getAttributeEntities(): Collection
    {
        return $this->attributeEntities;
    }
}
