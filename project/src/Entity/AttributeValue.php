<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Repository\AttributeValueRepository;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Attribute\SerializedName;

#[ORM\Entity(repositoryClass: AttributeValueRepository::class)]
#[Gedmo\SoftDeleteable]
class AttributeValue
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['value:index'])]
    #[SerializedName('attributeValueId')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'attributeValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AttributeEntity $attribute = null;

    #[ORM\ManyToOne(inversedBy: 'attributeValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ValueEntity $value = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAttribute(): ?AttributeEntity
    {
        return $this->attribute;
    }

    public function setAttribute(?AttributeEntity $attribute): static
    {
        $this->attribute = $attribute;

        return $this;
    }

    public function getValue(): ?ValueEntity
    {
        return $this->value;
    }

    public function setValue(?ValueEntity $value): static
    {
        $this->value = $value;

        return $this;
    }

    #[Groups(['value:index'])]
    public function getName(): ?array
    {
        return $this->getValue()->getName();
    }
}
