<?php

namespace App\Dto\WebNomenclature;

use App\Entity\ClientArticleAttribute;
use App\Entity\MultiStore;
use App\Entity\Nomenclature;
use App\Entity\WebNomenclature;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_nomenclature:article_attributes'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:article_attribute'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        #[Exists(WebNomenclature::class)]
        public ?int $webNomenclatureId,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        #[Assert\All(constraints: [new Assert\NotBlank(), new Assert\Positive()], groups: ['web_nomenclature:assign'])]
        public ?array $attributeValues,
        #[Groups(['web_nomenclature:create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        #[Exists(Nomenclature::class)]
        public ?int $nomenclatureId,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:create'])]
        public ?string $title,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update', 'web_nomenclature:article_attributes'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:article_attributes'])]
        public ?string $article,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create', 'web_nomenclature:update'])]
        public ?array $images,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        public ?string $description,
        #[Groups(['web_nomenclature:create', 'web_nomenclature:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['web_nomenclature:create'])]
        public ?string $document,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        public ?string $attributeUz,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        public ?string $attributeRu,
        #[Groups(['web_nomenclature:client_article'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article'])]
        public ?string $attributeUzc,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        public ?string $valueUz,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        public ?string $valueRu,
        #[Groups(['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_update', 'web_nomenclature:client_article_value_create'])]
        public ?string $valueUzc,
        #[Groups(['web_nomenclature:client_article_value_create'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:client_article_value_create'])]
        #[Exists(ClientArticleAttribute::class)]
        public ?int $clientArticleAttributeId,
        #[Groups(['web_nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:update'])]
        public ?bool $isActive = true,
        #[Groups(['web_nomenclature:update'])]
        #[Assert\Type(['bool', 'null'], groups: ['web_nomenclature:update'])]
        public ?bool $showComment = true,
        #[Groups(['web_nomenclature:assign'])]
        #[Assert\NotBlank(groups: ['web_nomenclature:assign'])]
        public ?bool $remember = false,
    ) {}

    public function getAttribute(): ?array
    {
        return ['uz' => $this->attributeUz, 'uzc' => $this->attributeUzc, 'ru' => $this->attributeRu];
    }

    public function getValue(): ?array
    {
        return ['uz' => $this->valueUz, 'uzc' => $this->valueUzc, 'ru' => $this->valueRu];
    }
}
