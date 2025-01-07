<?php

namespace App\Dto\ForgotPassword;

use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['forgot:password'])]
        #[Assert\NotBlank(groups: ['forgot:password'])]
        #[Assert\Email(groups: ['forgot:password'])]
        public ?string $email,
        #[Groups(['reset:password'])]
        #[Assert\NotBlank(groups: ['reset:password'])]
        #[Assert\Length(min: 6, groups: ['reset:password'])]
        public ?string $password,
        #[Groups(['reset:password'])]
        #[Assert\NotBlank(groups: ['reset:password'])]
        #[Assert\Length(min: 6, groups: ['reset:password'])]
        #[Assert\IdenticalTo(propertyPath: 'password', groups: ['reset:password'])]
        public ?string $passwordConfirmation,
    ) {}
}
