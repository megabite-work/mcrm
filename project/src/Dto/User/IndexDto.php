<?php

declare(strict_types=1);

namespace App\Dto\User;

use App\Dto\Address\IndexDto as AddressDto;
use App\Dto\Phone\IndexDto as PhoneDto;
use App\Entity\User;

final readonly class IndexDto
{
    /**
     * @param PhoneDto[] $phones
     */
    public function __construct(
        public ?int $id = null,
        public ?string $email = null,
        public ?string $username = null,
        public ?string $qrCode = null,
        public ?array $roles = null,
        public ?array $phones = null,
        public ?AddressDto $address = null
    ) {}

    public static function fromEntity(?User $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                email: $entity->getEmail(),
                username: $entity->getUserName(),
                qrCode: $entity->getQrCode(),
                roles: $entity->getRoles(),
            )
            : null;
    }

    public static function fromShowAction(?User $entity): ?static
    {
        return $entity
            ? new static(
                id: $entity->getId(),
                email: $entity->getEmail(),
                username: $entity->getUserName(),
                qrCode: $entity->getQrCode(),
                roles: $entity->getRoles(),
                phones: PhoneDto::fromEntityArray($entity->getPhones()->toArray()),
                address: AddressDto::fromEntity($entity->getAddress())
            )
            : null;
    }
}
