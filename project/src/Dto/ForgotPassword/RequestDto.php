<?php

namespace App\Dto\ForgotPassword;

use App\Entity\User;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['forgot:password'])]
        #[Assert\NotBlank(groups: ['forgot:password'])]
        #[Assert\Email(groups: ['forgot:password'])]
        #[Exists(User::class, field: 'email')]
        public ?string $email,
        #[Groups(['reset:password'])]
        #[Assert\NotBlank(groups: ['reset:password'])]
        #[Assert\Length(min: 6, groups: ['reset:password'])]
        public ?string $password,
    ) {}
}
