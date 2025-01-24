<?php

namespace App\Dto\WebBanner;

use App\Entity\MultiStore;
use App\Entity\WebBanner;
use App\Validator\Exists;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Choice;

final class RequestDto
{
    public function __construct(
        #[Groups(['web_banner:create'])]
        #[Assert\NotBlank(groups: ['web_banner:create'])]
        #[Exists(MultiStore::class)]
        public ?int $multiStoreId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: ['product', 'category', 'page', 'link'], groups: ['web_banner:create', 'web_banner:update'])]
        public string $type,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        public string $typeId,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\All([new Choice(choices: ['product', 'category', 'page', 'all'])], groups: ['web_banner:create', 'web_banner:update'])]
        public ?array $showType,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        public ?array $showTypeId = null,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Collection(
            fields: [
                'url' => [new Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update']), new Assert\Regex('/^media\/[a-zA-Z0-9]+\.(jpg|jpeg|png|gif|webp|pdf|xlsx|xls|doc|docx)$/', groups: ['web_banner:create', 'web_banner:update'])],
                'width' => [new Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update']), new Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])],
                'height' => [new Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update']), new Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])],
            ],
            groups: ['web_banner:create', 'web_banner:update']
        )]
        public array $image,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        public string $title,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        public ?string $description = null,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: [WebBanner::OFF, WebBanner::UNIQUE, WebBanner::ALL], groups: ['web_banner:create', 'web_banner:update'])]
        public string $clickType,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\Choice(choices: [WebBanner::OFF, WebBanner::UNIQUE, WebBanner::ALL], groups: ['web_banner:create', 'web_banner:update'])]
        public string $viewType,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\Count(min: 1, max: 3, groups: ['web_banner:create', 'web_banner:update'])]
        #[Assert\All(
            constraints: [new Assert\Choice(choices: [WebBanner::PC, WebBanner::MOBILE, WebBanner::TABLET])],
            groups: ['web_banner:create', 'web_banner:update']
        )]
        public array $devices,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'])]
        public string $beginAt,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\NotBlank(groups: ['web_banner:create', 'web_banner:update'], allowNull: true)]
        public ?string $endAt = null,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        public int $clickMax = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        public int $clickCurrent = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        public int $viewMax = 0,
        #[Groups(['web_banner:create', 'web_banner:update'])]
        #[Assert\PositiveOrZero(groups: ['web_banner:create', 'web_banner:update'])]
        public int $viewCurrent = 0,
        #[Groups(['web_banner:update'])]
        #[Assert\Type('bool', groups: ['web_banner:update'])]
        public bool $isActive = true,
    ) {}
}
