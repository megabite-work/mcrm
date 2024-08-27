<?php

namespace App\Dto\WebNomenclature;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        private ?int $webNomenclatureId,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        #[Assert\All(constraints: [new Assert\NotBlank(), new Assert\Positive()], groups: ['web_nomenclature:assign'])]
        private ?array $attributeValues,
        #[Groups(['web_nomenclature:create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        private ?int $nomenclatureId,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        private ?string $title,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        private ?string $article,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create', 'web_nomenclature:update'])]
        private ?array $images,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        private ?string $description,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        private ?string $document,
        #[Groups(['web_nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:update'])]
        private ?bool $isActive = true
    ) {}

    public function getNomenclatureId(): ?int
    {
        return $this->nomenclatureId;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getArticle(): ?string
    {
        return $this->article;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getWebNomenclatureId(): ?int
    {
        return $this->webNomenclatureId;
    }

    public function getAttributeValues(): ?array
    {
        return $this->attributeValues;
    }
}
