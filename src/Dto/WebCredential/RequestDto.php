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
                new Assert\Collection(
                    fields: [
                        'type' => [new Assert\NotBlank(groups: ['web_credential:update']), new Assert\Choice(choices: WebCredential::SOCIAL_TYPES, groups: ['web_credential:update'])],
                        'login' => [new Assert\NotBlank(groups: ['web_credential:update']), new Assert\Type(type: 'string', groups: ['web_credential:update'])],
                        'password' => [new Assert\NotBlank(groups: ['web_credential:update']), new Assert\Type(type: 'string', groups: ['web_credential:update'])],
                    ],
                    groups: ['web_credential:update']
                )
            ],
            groups: ['web_credential:update']
        )]
        public ?array $secrets,
        #[Groups(['web_credential:update'])]
        #[Assert\All(
            constraints: [
                new Assert\Collection(
                    fields: [
                        'type' => [new Assert\NotBlank(groups: ['web_credential:update']), new Assert\Choice(choices: WebCredential::SOCIAL_TYPES, groups: ['web_credential:update'])],
                        'url' => [new Assert\NotBlank(groups: ['web_credential:update']), new Assert\Regex(pattern: '/^(\+?[1-9]\d{1,14}|https?:\/\/[^\s$.?#].[^\s]*|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/', groups: ['web_credential:update'])],
                        'header' => [new Assert\Type(type: 'bool', groups: ['web_credential:update'])],
                        'footer' => [new Assert\Type(type: 'bool', groups: ['web_credential:update'])],
                    ],
                    groups: ['web_credential:update']
                )
            ],
            groups: ['web_credential:update']
        )]
        public ?array $social,
        #[Groups(['web_credential:update'])]
        #[Assert\Choice(choices: WebCredential::BUY_TYPES, groups: ['web_credential:update'])]
        public ?string $buyType,
        #[Groups(['web_credential:update'])]
        public ?string $buyValue,
        #[Groups(['web_credential:update'])]
        public ?string $buyTitle,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?string $logo,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?string $about,
        #[Groups(['web_credential:create', 'web_credential:update'])]
        public ?int $templateId,
    ) {}
}
