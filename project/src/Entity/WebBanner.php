<?php

namespace App\Entity;

use App\Repository\WebBannerRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebBannerRepository::class)]
#[Gedmo\SoftDeleteable]
class WebBanner
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'webBanners')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?int $type_id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $image = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getTypeId(): ?int
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id): static
    {
        $this->type_id = $type_id;

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
