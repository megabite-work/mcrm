<?php

namespace App\Entity;

use App\Repository\WebViewRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: WebViewRepository::class)]
class WebView
{
    public const TYPE_ABOUT = 'photo';
    public const TYPE_TITLE = 'title';
    public const TYPE_BRAND = 'brand';
    public const TYPE_RATING = 'rating';
    public const TYPE_PRICE = 'price';
    public const TYPE_DISCOUNT = 'discount';
    public const TYPE_FAVORITE = 'favorite';
    public const TYPE_COMMENT = 'comment';
    public const TYPE_UNIT = 'unit';
    public const TYPE_QUANTITY = 'quantity';
    public const TYPE_BUTTON = 'button';
    public const TYPES = [
        WebView::TYPE_ABOUT,
        WebView::TYPE_TITLE,
        WebView::TYPE_BRAND,
        WebView::TYPE_RATING,
        WebView::TYPE_PRICE,
        WebView::TYPE_DISCOUNT,
        WebView::TYPE_FAVORITE,
        WebView::TYPE_COMMENT,
        WebView::TYPE_UNIT,
        WebView::TYPE_QUANTITY,
        WebView::TYPE_BUTTON,
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['web_view:index', 'web_view:show', 'web_view:create', 'web_view:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['web_view:index', 'web_view:show', 'web_view:create', 'web_view:update'])]
    private ?int $multiStoreId = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(choices: WebView::TYPES)]
    #[Groups(['web_view:index', 'web_view:show', 'web_view:create', 'web_view:update'])]
    private ?string $type = null;

    #[ORM\Column]
    #[Groups(['web_view:index', 'web_view:show', 'web_view:create', 'web_view:update'])]
    private ?bool $isActive = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMultiStoreId(): ?int
    {
        return $this->multiStoreId;
    }

    public function setMultiStoreId(?int $multiStoreId): static
    {
        $this->multiStoreId = $multiStoreId;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

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
