<?php

namespace App\Entity;

use App\Repository\WebCredentialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: WebCredentialRepository::class)]
#[ORM\Table(name: 'web_credential')]
#[Gedmo\SoftDeleteable]
class WebCredential
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    public const TYPE_CLASS = 'class';
    public const TYPE_CATEGORY = 'category';
    public const TYPE_SUBCATEGORY = 'subcategory';
    public const BUY_TYPE_PHONE = 'phone';
    public const BUY_TYPE_LINK = 'link';
    public const TYPES = [
        WebCredential::TYPE_CLASS,
        WebCredential::TYPE_CATEGORY,
        WebCredential::TYPE_SUBCATEGORY
    ];
    public const BUY_TYPES = [
        WebCredential::BUY_TYPE_PHONE,
        WebCredential::BUY_TYPE_LINK,
    ];
    public const SOCIAL_TYPES = ['email', 'phone', 'add_phone', 'youtube', 'telegram', 'instagram', 'facebook', 'tiktok'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: MultiStore::class, inversedBy: 'webCredential')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $logo = null;

    #[ORM\Column(type: TYPES::TEXT, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $about = null;

    #[ORM\Column(nullable: true, type: Types::BIGINT, options: ['default' => 5952022000000])]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?int $article = 5952022000000;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $secrets = null;

    #[ORM\Column(nullable: true, type: Types::TEXT)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $social = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?int $templateId = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $catalogType = WebCredential::TYPE_CLASS;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $catalogTypeId = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $buyType = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $buyTitle = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['web_credential:index', 'web_credential:show', 'web_credential:create', 'web_credential:update', 'multi_store:show'])]
    private ?string $buyValue = null;

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

    public function getArticle(): ?int
    {
        return $this->article;
    }

    public function setArticle(?int $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getSecrets(): ?array
    {
        return json_decode($this->secrets, true);
    }

    public function setSecrets(?array $secrets): static
    {
        $this->secrets = json_encode($secrets, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getSocial(): ?array
    {
        return json_decode($this->social, true);
    }

    public function setSocial(?array $social): static
    {
        $this->social = json_encode($social, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): static
    {
        $this->about = $about;

        return $this;
    }

    public function getTemplateId(): ?int
    {
        return $this->templateId;
    }

    public function setTemplateId(?int $templateId): static
    {
        $this->templateId = $templateId;

        return $this;
    }

    public function getCatalogType(): ?string
    {
        return $this->catalogType;
    }

    public function setCatalogType(?string $catalogType): static
    {
        $this->catalogType = $catalogType;

        return $this;
    }

    public function getCatalogTypeId(): ?array
    {
        return json_decode($this->catalogTypeId, true);
    }

    public function setCatalogTypeId(?array $catalogTypeId): static
    {
        $this->catalogTypeId = json_encode($catalogTypeId, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getBuyType(): ?string
    {
        return $this->buyType;
    }

    public function setBuyType(?string $buyType): static
    {
        $this->buyType = $buyType;

        return $this;
    }

    public function getBuyValue(): ?string
    {
        return $this->buyValue;
    }

    public function setBuyValue(?string $buyValue): static
    {
        $this->buyValue = $buyValue;

        return $this;
    }

    public function getBuyTitle(): ?string
    {
        return $this->buyTitle;
    }

    public function setBuyTitle(?string $buyTitle): static
    {
        $this->buyTitle = $buyTitle;

        return $this;
    }
}
