<?php

namespace App\Entity;

use App\Repository\WebBannerRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $type_id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $image = null;

    #[ORM\Column(options: ['default' => true])]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?bool $isActive = true;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $devices = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $click_type = null;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $click_max = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $click_current = 0;

    #[ORM\Column(length: 255)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?string $view_type = null;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $view_max = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private int $view_current = 0;

    #[ORM\Column]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?DateTime $begin_at = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_banner:index', 'web_banner:show', 'web_banner:create', 'web_banner:update'])]
    private ?DateTime $end_at = null;

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

    public function getTypeId(): ?string
    {
        return $this->type_id;
    }

    public function setTypeId(string $type_id): static
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

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

    public function getBeginAt(): ?DateTime
    {
        return $this->begin_at;
    }

    public function setBeginAt(?string $begin_at): static
    {
        $this->begin_at = date_create($begin_at);

        return $this;
    }

    public function getDevices(): ?array
    {
        return json_decode($this->devices);
    }

    public function setDevices(?array $devices): static
    {
        $this->devices = json_encode($devices, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getClickType(): ?string
    {
        return $this->click_type;
    }

    public function setClickType(?string $click_type): static
    {
        $this->click_type = $click_type;

        return $this;
    }

    public function getClickMax(): ?int
    {
        return $this->click_max;
    }

    public function setClickMax(?int $click_max): static
    {
        $this->click_max = $click_max;

        return $this;
    }

    public function getClickCurrent(): ?int
    {
        return $this->click_current;
    }

    public function setClickCurrent(?int $click_current): static
    {
        $this->click_current = $click_current;

        return $this;
    }

    public function getViewType(): ?string
    {
        return $this->view_type;
    }

    public function setViewType(?string $view_type): static
    {
        $this->view_type = $view_type;

        return $this;
    }

    public function getViewMax(): ?int
    {
        return $this->view_max;
    }

    public function setViewMax(?int $view_max): static
    {
        $this->view_max = $view_max;

        return $this;
    }

    public function getViewCurrent(): ?int
    {
        return $this->view_current;
    }

    public function setViewCurrent(?int $view_current): static
    {
        $this->view_current = $view_current;

        return $this;
    }

    public function getEndAt(): ?DateTime
    {
        return $this->end_at;
    }

    public function setEndAt(?string $end_at): static
    {
        $this->end_at = $end_at ? date_create($end_at) : null;

        return $this;
    }
}
