<?php

namespace App\Dto\Category;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['category:create', 'category:update'])]
        private ?int $parentId,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        private ?string $nameUz,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        private ?string $nameUzc,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(groups: ['category:create'])]
        private ?string $nameRu,
        #[Groups(['category:create', 'category:update'])]
        #[Assert\NotBlank(allowNull: true, groups: ['category:create', 'category:update'])]
        private ?string $image,
        #[Groups(['category:update'])]
        #[Assert\Type('bool', groups: ['category:update'])]
        private ?bool $isActive = true
    ) {
    }

    public function getNameUz(): ?string
    {
        return $this->nameUz;
    }

    public function getNameUzc(): ?string
    {
        return $this->nameUzc;
    }

    public function getNameRu(): ?string
    {
        return $this->nameRu;
    }

    public function getName(): ?array
    {
        return ['ru' => $this->getNameRu(), 'uz' => $this->getNameUz(), 'uzc' => $this->getNameUzc()];
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }
}
