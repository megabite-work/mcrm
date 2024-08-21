<?php

namespace App\Dto\CashboxGlobal;

use App\Dto\CashboxGlobal\UpdateRequestDto;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

final class RequestDto
{
    public function __construct(
        #[Groups(['cashbox_global:create'])]
        #[Assert\NotBlank(groups: ['cashbox_global:create'])]
        private ?int $cashboxDetailId,
        #[Groups(['cashbox_global:create'])]
        private array $items = []
    ) {}

    public function getCashboxDetailId(): ?int
    {
        return $this->cashboxDetailId;
    }

    public function getItems(): array
    {
        return array_map(function ($item) {
            return new UpdateRequestDto(
                $item['nomenclatureId'] ?? null,
                $item['qty'] ?? null,
                $item['oldPrice'] ?? null,
                $item['price'] ?? null,
                $item['oldPriceCourse'] ?? null,
                $item['priceCourse'] ?? null,
                $item['nds'] ?? null,
                $item['ndsSum'] ?? null,
                $item['discount'] ?? null,
                $item['discountSum'] ?? null,
            );
        }, $this->items);
    }
}
