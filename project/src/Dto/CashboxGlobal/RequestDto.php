<?php

namespace App\Dto\CashboxGlobal;

use App\Dto\CashboxGlobal\UpdateRequestDto;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_global:create'])]
        #[Assert\NotBlank(groups: ['cashbox_global:create'])]
        private ?int $cashboxDetailId,
        #[Groups(['cashbox_global:create'])]
        #[Assert\All([new Assert\Type(type: UpdateRequestDto::class)])]
        #[Assert\Valid()]
        private array $items = []
    ) {}

    public function getCashboxDetailId(): ?int
    {
        return $this->cashboxDetailId;
    }

    public function getItems(): array
    {
        return array_map(function ($tagData) {
            return new UpdateRequestDto($tagData['name'], $tagData['description'] ?? null);
        }, $this->items);
    }
}
