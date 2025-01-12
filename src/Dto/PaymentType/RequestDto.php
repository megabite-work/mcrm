<?php

namespace App\Dto\PaymentType;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        #[Assert\Choice(choices: ['ordinary', 'e-wallets'], groups: ['payment_type:create'])]
        public ?string $type,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        public ?string $nameUz,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        public ?string $nameUzc,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        public ?string $nameRu,
        #[Groups(['payment_type:create', 'payment_type:update'])]
        #[Assert\NotBlank(groups: ['payment_type:create'])]
        public ?string $nameEn,
    ) {}

    public function getName(): ?array
    {
        return ['en' => $this->nameEn, 'ru' => $this->nameRu, 'uz' => $this->nameUz, 'uzc' => $this->nameUzc];
    }
}
