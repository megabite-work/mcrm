<?php

namespace App\Dto\WebCredential;

use App\Entity\Category;
use App\Entity\MultiStore;
use App\Entity\WebCredential;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_credential:create'])]
        #[Assert\NotBlank(groups: ['web_credential:create'])]
        #[Exists(MultiStore::class, groups: ['web_credential:create'])]
        public ?int $multiStoreId,
        #[Groups(['web_credential:update'])]
        #[Assert\Choice(choices: WebCredential::TYPES, groups: ['web_credential:update'])]
        public ?string $catalogType,
        #[Groups(['web_credential:update'])]
        #[Assert\All([new Exists(Category::class)], groups: ['web_credential:update'])]
        public ?array $catalogTypeId,
        #[Groups(['web_credential:update'])]
        #[Assert\All(
            constraints: [
                new Assert\Collection([
                    'fields' => [
                        'type' => [new Assert\NotBlank(), new Assert\Choice(['choices' => WebCredential::SOCIAL_TYPES])],
                        'login' => [new Assert\NotBlank(), new Assert\Type('string')],
                        'password' => [new Assert\NotBlank(), new Assert\Type('string')],
                    ],
                ])
            ],
            groups: ['web_credential:update']
        )]
        public ?array $secrets,
        #[Groups(['web_credential:update'])]
        #[Assert\All(
            constraints: [
                new Assert\Collection([
                    'fields' => [
                        'type' => [new Assert\NotBlank(), new Assert\Choice(['choices' => WebCredential::SOCIAL_TYPES])],
                        'url' => [new Assert\NotBlank(), new Assert\Url()],
                        'footer' => [new Assert\NotBlank(), new Assert\Type(['type' => 'bool'])],
                        'header' => [new Assert\NotBlank(), new Assert\Type(['type' => 'bool'])],
                    ],
                ])
            ],
            groups: ['web_credential:update']
        )]
        public ?array $social,
        #[Groups(['web_credential:update'])]
        #[Assert\Choice(choices: WebCredential::BUY_TYPES, groups: ['web_credential:update'])]
        public ?string $buyType,
        #[Groups(['web_credential:update'])]
        public ?string $buyValue,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?string $logo,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?string $about,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?int $templateId,
    ) {}
}
