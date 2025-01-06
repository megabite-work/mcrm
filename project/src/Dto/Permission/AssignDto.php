<?php

namespace App\Dto\Permission;

use App\Entity\Permission;
use App\Entity\User;
use App\Validator\Exists;
use Symfony\Component\Validator\Constraints as Assert;

final class AssignDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Exists(User::class)]
        public ?int $userId,
        #[Assert\NotBlank]
        #[Exists(Permission::class)]
        public ?int $permissionId,
    ) {}
}
