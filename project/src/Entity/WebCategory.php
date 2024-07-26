<?php

namespace App\Entity;

use App\Repository\WebCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: WebCategoryRepository::class)]
#[ORM\Table(name: 'web_category')]
#[Gedmo\SoftDeleteable]
final class WebCategory
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_category:read'])]
    private ?int $id = null;

    #[ORM\Column(name: 'parent_id')]
    #[Groups(['web_category:read', 'web_category:write'])]
    private ?int $parentId = null;

    #[ORM\Column(type: 'json')]
    #[Groups(['web_category:read', 'web_category:write'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['web_category:read', 'web_category:write'])]
    private ?string $image = null;

    #[ORM\Column(name: 'is_active')]
    #[Groups(['web_category:read', 'web_category:write'])]
    private ?int $isActive = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): static
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
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
