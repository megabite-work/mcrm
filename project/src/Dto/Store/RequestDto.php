<?php

namespace App\Dto\Store;

use App\Entity\MultiStore;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['store:create', 'store:update'])]
        #[Assert\NotBlank(groups: ['store:create'])]
        public ?string $name,
        #[Groups(['store:create'])]
        #[Assert\NotBlank(groups: ['store:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['store:update'])]
        public ?string $region,
        #[Groups(['store:update'])]
        public ?string $district,
        #[Groups(['store:update'])]
        public ?string $street,
        #[Groups(['store:update'])]
        public ?string $house,
        #[Groups(['store:update'])]
        public ?string $latitude,
        #[Groups(['store:update'])]
        public ?string $longitude,
        #[Groups(['store:update'])]
        public ?array $phones,
        #[Groups(['store:update'])]
        #[Assert\Type('bool', groups: ['store:update'])]
        public ?bool $isActive = true
    ) {}
}
