<?php

namespace App\Dto\User;

use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['user:create', 'user:update', 'unique:email', 'user:create_worker', 'user:create_user'])]
        #[Assert\Email(groups: ['user:create', 'unique:email', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'unique:email', 'user:create_worker', 'user:create_user'])]
        public ?string $email,
        #[Groups(['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        #[Assert\Length(min: 3, groups: ['user:create', 'unique:username', 'user:create_worker', 'user:create_user'])]
        public ?string $username,
        #[Groups(['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        #[Assert\NotBlank(groups: ['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        #[Assert\Length(min: 6, groups: ['user:create', 'change:password', 'user:create_worker', 'user:create_user'])]
        public ?string $password,
        #[Groups(['change:password'])]
        #[SerializedName('old_password')]
        #[Assert\NotBlank(groups: ['change:password'])]
        public ?string $oldPassword,
        #[Groups(['change:password'])]
        #[SerializedName('confirm_password')]
        #[Assert\NotBlank(groups: ['change:password'])]
        #[Assert\Length(min: 6, groups: ['change:password'])]
        #[Assert\IdenticalTo(propertyPath: 'password', groups: ['change:password'])]
        public ?string $confirmPassword,
        #[Groups(['user:update'])]
        public ?string $region,
        #[Groups(['user:update'])]
        public ?string $district,
        #[Groups(['user:update'])]
        public ?string $street,
        #[Groups(['user:update'])]
        public ?string $house,
        #[Groups(['user:update'])]
        public ?string $latitude,
        #[Groups(['user:update'])]
        public ?string $longitude,
        #[Groups(['user:update'])]
        public ?array $phones,
        #[Groups(['user:create_worker'])]
        #[Assert\NotBlank(groups: ['user:create_worker'])]
        public ?int $role,
        #[Groups(['user:create_worker'])]
        #[Assert\NotBlank(groups: ['user:create_worker'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
    ) {}
}
