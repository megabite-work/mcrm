<?php

namespace App\Entity;

use App\Repository\ArticleAttributeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArticleAttributeRepository::class)]
#[Gedmo\SoftDeleteable]
class ArticleAttribute
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?MultiStore $multiStore = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?int $article = null;

    #[ORM\Column(length: 255)]
    #[Groups(['web_nomenclature:article_attributes'])]
    private ?string $attributes = null;

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

    public function setArticle(int $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getAttributes(): ?array
    {
        return json_decode($this->attributes, true);
    }

    public function setAttributes(array $attributes): static
    {
        $this->attributes = json_encode($attributes, JSON_UNESCAPED_UNICODE);

        return $this;
    }
}