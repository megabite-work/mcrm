<?php

namespace App\Dto\ForgiveType;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        private ?string $nameUz,
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        private ?string $nameUzc,
        #[Groups(['forgive_type:create', 'forgive_type:update'])]
        #[Assert\NotBlank(groups: ['forgive_type:create'])]
        private ?string $nameRu,
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
}
