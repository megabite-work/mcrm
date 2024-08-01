<?php

namespace App\Dto\User;

use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class ChangePasswordRequestDto
{
    public function __construct(
        #[SerializedName('old_password')]
        #[Assert\NotBlank]
        private ?string $oldPassword,
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        private ?string $password,
        #[SerializedName('confirm_password')]
        #[Assert\NotBlank]
        #[Assert\Length(min: 6)]
        #[Assert\IdenticalTo(propertyPath: 'password')]
        private ?string $confirmPassword
    ) {
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
    }
}
