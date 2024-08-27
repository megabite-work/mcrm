<?php

namespace App\Dto\Attribute;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['attribute:create'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        private ?int $categoryId,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        private ?string $nameUz,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        private ?string $nameUzc,
        #[Groups(['attribute:create', 'attribute:update'])]
        #[Assert\NotBlank(groups: ['attribute:create'])]
        private ?string $nameRu,
    ) {}

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

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }
}
